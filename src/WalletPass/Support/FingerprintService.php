<?php

namespace MarcinJean\WalletPass\Support;

use MarcinJean\WalletPass\Models\WalletPassState;

class FingerprintService
{
    public static function findDuplicate(string $fingerprint, string $walletType): ?WalletPassState
    {
        return WalletPassState::where('fingerprint', $fingerprint)
            ->where('wallet_type', $walletType)
            ->first();
    }
}