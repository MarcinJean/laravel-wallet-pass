<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class InstallWalletPass extends Command
{
    protected $signature = 'walletpass:install';
    protected $description = 'Install and configure the Wallet Pass system';

    public function handle(): int
    {
        $this->info('🔧 Installing Wallet Pass System...');

        // Publish config
        $this->callSilent('vendor:publish', ['--tag' => 'walletpass-config']);
        $this->info('✅ Config file published');

        // Publish migration stub to real migration file
        $timestamp = now()->format('Y_m_d_His');
        $migrationPath = database_path("migrations/{$timestamp}_create_wallet_pass_tables.php");
        $stubPath = __DIR__ . '/../../../stubs/migrations/wallet_pass_tables.stub';
        copy($stubPath, $migrationPath);
        $this->info("✅ Migration created: {$migrationPath}");

        // Run migration if not yet done
        if (!Schema::hasTable('wallet_pass_states')) {
            $this->call('migrate');
            $this->info('✅ Database migrated');
        }

        // Nova integration
        if (class_exists(\Laravel\Nova\Nova::class) && config('walletpass.nova.enable')) {
            $this->info('🧭 Laravel Nova detected — enabling admin resources...');
            $this->callSilent('vendor:publish', [
                '--tag' => 'walletpass-nova',
                '--force' => true,
            ]);
            $this->info('✅ Nova resources and metrics published');
        } else {
            $this->warn('⚠️ Nova support skipped (not installed or disabled in config)');
        }

        $this->info('🎉 Wallet Pass setup complete!');
        return self::SUCCESS;
    }
}