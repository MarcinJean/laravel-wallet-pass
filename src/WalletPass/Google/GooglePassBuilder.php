<?php

namespace MarcinJean\WalletPass\Google;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use MarcinJean\WalletPass\Models\WalletPassState;
use MarcinJean\WalletPass\Support\PassTracker;

class GooglePassBuilder
{
    protected string $issuerId;
    protected string $credentialsPath;

    public function __construct()
    {
        $this->issuerId = config('walletpass.google.issuer_id');
        $this->credentialsPath = config('walletpass.google.credentials_path');
    }

    public function create(WalletPassState $pass): string
    {
        $objectId = $this->issuerId . '.' . ($pass->serial ?? strtolower(Str::random(12)));

        $passData = [
            'id' => $objectId,
            'classId' => "{$this->issuerId}.CouponClass",
            'barcode' => [
                'type' => 'code128',
                'value' => $pass->barcode,
                'alternateText' => 'Scan at service desk',
            ],
            'state' => 'active',
            'validTimeInterval' => [
                'start' => now()->toIso8601String(),
                'end' => optional($pass->expires_at)->toIso8601String() ?? now()->addDays(30)->toIso8601String(),
            ],
        ];

        foreach ($pass->localized_strings ?? [] as $lang => $strings) {
            $passData['localizedStrings'][$lang] = [
                'label' => $strings['label'] ?? 'Coupon',
                'value' => $strings['value'] ?? '$0',
            ];
        }

        // Simulated save (normally sent to Google API)
        Storage::put("passes/{$objectId}.json", json_encode($passData));

        PassTracker::log($pass, 'created', ['platform' => 'google']);

        return "https://pay.google.com/gp/v/save/{$objectId}";
    }

    public function patchUpdate(string $objectId): void
    {
        public function patchUpdate(string $objectId): void
    {
        // Simulated PATCH logic (would use Google Wallet REST API with OAuth2)

        $patchData = [
            'state' => 'active',
            'messages' => [
                [
                    'header' => 'Pass Updated',
                    'body' => 'Your coupon has been refreshed.',
                ]
            ]
        ];

        // Store a simulation of the patch payload
        \Illuminate\Support\Facades\Storage::put("patches/{$objectId}_patch.json", json_encode($patchData, JSON_PRETTY_PRINT));

        // Log it for internal audit trail
        \MarcinJean\WalletPass\Support\PassTracker::log(
            \MarcinJean\WalletPass\Models\WalletPassState::where('serial', basename($objectId))->firstOrFail(),
            'refreshed',
            ['platform' => 'google']
        );
    }
    }
}