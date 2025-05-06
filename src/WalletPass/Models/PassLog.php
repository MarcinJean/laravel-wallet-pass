<?php

namespace MarcinJean\WalletPass\Models;

use Illuminate\Database\Eloquent\Model;

class PassLog extends Model
{
    protected $guarded = [];

    protected $casts = [
        'meta' => 'array',
    ];

    public function walletPassState()
    {
        return $this->belongsTo(WalletPassState::class);
    }
}