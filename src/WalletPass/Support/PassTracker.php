<?php

namespace MarcinJean\WalletPass\Support;

use Illuminate\Support\Facades\Log;
use MarcinJean\WalletPass\Facades\WalletPass;
use MarcinJean\WalletPass\Models\WalletPassState;
use MarcinJean\WalletPass\Models\PassLog;

class PassTracker
{
    public static function log(WalletPassState $pass, string $event, array $meta = []): void
    {
        $combinedMeta = array_merge(
            WalletPass::getLogMeta(),
            $meta ?? []
        );

        PassLog::create([
            'wallet_pass_state_id' => $pass->id,
            'event' => $event,
            'source_ip' => request()?->ip(),
            'user_agent' => request()?->userAgent(),
            'meta' => !empty($combinedMeta) ? json_encode($combinedMeta) : null,
        ]);
    }
}