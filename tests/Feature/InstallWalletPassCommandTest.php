<?php

test('it publishes migration and config via install command', function () {
    $this->artisan('walletpass:install')
        ->assertExitCode(0)
        ->expectsOutputToContain('Config file published')
        ->expectsOutputToContain('Migration created')
        ->expectsOutputToContain('Wallet Pass setup complete!');
});