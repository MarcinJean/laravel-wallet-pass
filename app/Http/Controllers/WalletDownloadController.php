<?php

namespace App\Http\Controllers;

use MarcinJean\WalletPass\Models\WalletPassState;

class WalletDownloadController extends Controller
{
    public function download(string $serial)
    {
        $pass = WalletPassState::where('serial', $serial)->firstOrFail();

        // Simulate serving pass (actual logic omitted)
        return response('Wallet file for ' . $serial);
    }
}