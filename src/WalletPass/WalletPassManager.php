<?php

namespace MarcinJean\WalletPass;

use MarcinJean\WalletPass\Models\WalletPassState;
use MarcinJean\WalletPass\Support\PassTracker;
use MarcinJean\WalletPass\Support\BarcodeGenerator;
use MarcinJean\WalletPass\Support\FingerprintService;
use MarcinJean\WalletPass\Apple\ApplePassBuilder;
use MarcinJean\WalletPass\Google\GooglePassBuilder;

class WalletPassManager
{
    protected array $logMeta = [];

    public function createCoupon(array $data): WalletPassState
    {
        $existing = isset($data['fingerprint'])
            ? FingerprintService::findDuplicate($data['fingerprint'], $data['wallet_type'])
            : null;

        if ($existing) return $existing;

        $barcode = BarcodeGenerator::generate($data['prefix']);

        $pass = WalletPassState::create([
            'wallet_type' => $data['wallet_type'],
            'barcode' => $barcode,
            'fingerprint' => $data['fingerprint'] ?? null,
            'localized_strings' => $data['localized_strings'] ?? [],
            'expires_at' => $data['expires_at'] ?? now()->addDays(30),
        ]);

        PassTracker::log($pass, 'created', $data['meta'] ?? []);

        return $pass;
    }

    public function redeem(string $serial): void
    {
        $pass = WalletPassState::where('serial', $serial)->firstOrFail();
        $pass->update(['redeemed' => true]);

        PassTracker::log($pass, 'redeemed');
    }

    public function refresh(string $serial): void
    {
        $pass = WalletPassState::where('serial', $serial)->firstOrFail();
        PassTracker::log($pass, 'refreshed');

        if ($pass->wallet_type === 'apple') {
            (new ApplePassBuilder)->pushUpdate($serial);
        } else {
            (new GooglePassBuilder)->patchUpdate($serial);
        }
    }

    public function revoke(string $serial): void
    {
        $pass = WalletPassState::where('serial', $serial)->firstOrFail();
        $pass->update(['revoked' => true]);
        PassTracker::log($pass, 'revoked');
    }

    public function downloadUrl(WalletPassState $pass): string
    {
        return route('wallet.download', ['serial' => $pass->serial]);
    }

    public function setLogMeta(array $meta): static
    {
        $this->logMeta = $meta;
        return $this;
    }

    public function getLogMeta(): array
    {
        return $this->logMeta;
    }
}