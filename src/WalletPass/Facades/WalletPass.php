<?php

namespace MarcinJean\WalletPass\Facades;

use Illuminate\Support\Facades\Facade;

class WalletPass extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \MarcinJean\WalletPass\WalletPassManager::class;
    }
}