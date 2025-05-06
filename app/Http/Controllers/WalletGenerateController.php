<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MarcinJean\WalletPass\Facades\WalletPass;

class WalletGenerateController extends Controller
{
    public function store(Request $request)
    {
        $pass = WalletPass::createCoupon($request->all());

        return response()->json([
            'url' => WalletPass::downloadUrl($pass),
        ]);
    }
}