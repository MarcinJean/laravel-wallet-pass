<?php

use Carbon\Carbon;
use MarcinJean\WalletPass\Models\WalletPassState;

test('status helper returns correct lifecycle state', function () {
    $active = WalletPassState::factory()->create();
    $redeemed = WalletPassState::factory()->create(['redeemed' => true]);
    $revoked = WalletPassState::factory()->create(['revoked' => true]);
    $expired = WalletPassState::factory()->create(['expires_at' => Carbon::now()->subDay()]);

    expect($active->status())->toBe('ACTIVE');
    expect($redeemed->status())->toBe('REDEEMED');
    expect($revoked->status())->toBe('REVOKED');
    expect($expired->status())->toBe('EXPIRED');
});