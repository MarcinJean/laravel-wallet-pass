<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WalletDownloadController;
use App\Http\Controllers\WalletGenerateController;

Route::post('/wallet/generate', [WalletGenerateController::class, 'store']);
Route::get('/wallet/download/{serial}', [WalletDownloadController::class, 'download'])->name('wallet.download');