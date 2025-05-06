<?php

namespace MarcinJean\WalletPass;

use Illuminate\Support\ServiceProvider;

class WalletPassServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/walletpass.php', 'walletpass');
        $this->app->singleton(WalletPassManager::class);
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../config/walletpass.php' => config_path('walletpass.php'),
        ], 'walletpass-config');

        $this->publishes([
            __DIR__.'/../../database/migrations/2025_01_01_000000_create_wallet_pass_tables.php' =>
                database_path('migrations/2025_01_01_000000_create_wallet_pass_tables.php'),
        ], 'walletpass-migrations');

        $this->publishes([
            __DIR__.'/../../stubs/nova/' => app_path('Nova'),
        ], 'walletpass-nova');
    }
}