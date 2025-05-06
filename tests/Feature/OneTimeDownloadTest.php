<?php

use Illuminate\Support\Facades\URL;
use MarcinJean\WalletPass\Models\WalletPassState;

test('it allows first download and blocks second if one-time download is enabled', function () {
    config(['walletpass.signed_download_urls' => true]);
    config(['walletpass.one_time_download' => true]);

    $pass = WalletPassState::factory()->create(['serial' => 'ABC123']);

    $url = URL::signedRoute('wallet.download', ['serial' => $pass->serial]);

    // First access
    $response1 = $this->get($url);
    $response1->assertOk();

    // Second access (should be blocked)
    $response2 = $this->get($url);
    $response2->assertForbidden();

    expect($pass->refresh()->downloaded_at)->not()->toBeNull();
});