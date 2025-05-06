<?php

use MarcinJean\WalletPass\Facades\WalletPass;

test('it reuses existing pass if fingerprint matches', function () {
    $first = WalletPass::createCoupon([
        'wallet_type' => 'apple',
        'prefix' => 'FREE',
        'label' => 'Brake Inspection',
        'value' => '$0',
        'fingerprint' => 'dupe-key',
    ]);

    $second = WalletPass::createCoupon([
        'wallet_type' => 'apple',
        'prefix' => 'FREE',
        'label' => 'Brake Inspection',
        'value' => '$0',
        'fingerprint' => 'dupe-key',
    ]);

    expect($first->id)->toBe($second->id);
});