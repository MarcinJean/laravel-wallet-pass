<?php

use MarcinJean\WalletPass\Facades\WalletPass;

test('localized strings persist across pass updates', function () {
    $pass = WalletPass::createCoupon([
        'wallet_type' => 'google',
        'prefix' => 'SAVE',
        'label' => 'Tire Rotation',
        'value' => '$15',
        'localized_strings' => [
            'en' => ['label' => 'Tire Rotation', 'value' => '$15'],
            'fr' => ['label' => 'Rotation des pneus', 'value' => '15 $'],
        ],
    ]);

    $pass->refresh();
    expect($pass->localized_strings['fr']['label'])->toBe('Rotation des pneus');
});