<?php

namespace MarcinJean\WalletPass\Apple;

use ZipArchive;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use MarcinJean\WalletPass\Models\WalletPassState;
use MarcinJean\WalletPass\Support\PassTracker;

class ApplePassBuilder
{
    protected string $certPath;
    protected string $certPassword;
    protected string $teamId;
    protected string $passTypeId;

    public function __construct()
    {
        $this->certPath = config('walletpass.apple.cert_path');
        $this->certPassword = config('walletpass.apple.cert_password');
        $this->teamId = config('walletpass.apple.team_id');
        $this->passTypeId = config('walletpass.apple.pass_type_id');
    }

    public function create(WalletPassState $pass): string
    {
        $serial = $pass->serial ?? strtoupper(Str::random(10));

        $passData = [
            'formatVersion' => 1,
            'serialNumber' => $serial,
            'teamIdentifier' => $this->teamId,
            'passTypeIdentifier' => $this->passTypeId,
            'barcode' => [
                'message' => $pass->barcode,
                'format' => 'PKBarcodeFormatCode128',
                'messageEncoding' => 'iso-8859-1',
            ],
            'organizationName' => 'Stivers Hyundai',
            'description' => 'Exclusive Service Coupon',
            'coupon' => [
                'primaryFields' => [
                    [
                        'key' => 'offer',
                        'label' => $pass->localized_strings['en']['label'] ?? 'Service Coupon',
                        'value' => $pass->localized_strings['en']['value'] ?? '$0',
                    ],
                ],
            ],
        ];

        if ($pass->expires_at) {
            $passData['expirationDate'] = Carbon::parse($pass->expires_at)->toIso8601String();
        }

        foreach ($pass->localized_strings ?? [] as $lang => $strings) {
            $passData['localized'][$lang] = [
                'coupon' => [
                    'primaryFields' => [
                        [
                            'key' => 'offer',
                            'label' => $strings['label'] ?? 'Service',
                            'value' => $strings['value'] ?? '',
                        ],
                    ],
                ],
            ];
        }

        // Simulated creation
        $path = storage_path("app/passes/{$serial}.pkpass");
        Storage::put("passes/{$serial}.json", json_encode($passData));

        PassTracker::log($pass, 'created', ['platform' => 'apple']);

        return $path;
    }

    public function pushUpdate(string $serial): void
    {
        public function pushUpdate(string $serial): void
    {
        // Simulated Apple push update logic (would call Apple's push notification service)
        $deviceTokens = [
            'example_device_token_1',
            'example_device_token_2'
        ];

        foreach ($deviceTokens as $token) {
            \Illuminate\Support\Facades\Storage::put("pushes/{$serial}_{$token}.json", json_encode([
                'pushType' => 'apple',
                'serial' => $serial,
                'deviceToken' => $token,
                'message' => 'Pass has been updated'
            ], JSON_PRETTY_PRINT));
        }

        \MarcinJean\WalletPass\Support\PassTracker::log(
            \MarcinJean\WalletPass\Models\WalletPassState::where('serial', $serial)->firstOrFail(),
            'refreshed',
            ['platform' => 'apple']
        );
    }
    }

    public function registerDevice(string $deviceId): void
    {
        // Simulated placeholder: stores or acknowledges device registration
    }
}