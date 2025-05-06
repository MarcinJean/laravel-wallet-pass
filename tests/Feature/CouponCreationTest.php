<?php

use MarcinJean\WalletPass\Facades\WalletPass;

test('it creates a wallet pass with correct barcode and metadata', function () {
    $pass = WalletPass::setLogMeta(['kiosk_id' => 'KIOSK-A'])->createCoupon([
        'wallet_type' => 'apple',
        'prefix' => 'FREE',
        'label' => 'Oil Change',
        'value' => '$0',
        'fingerprint' => 'abc123xyz',
    ]);

    expect($pass->barcode)->toMatch('/^FREE\d{6}$/');
    expect($pass->fingerprint)->toBe('abc123xyz');
    expect($pass->wallet_type)->toBe('apple');
});