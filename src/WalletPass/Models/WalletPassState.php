<?php

namespace MarcinJean\WalletPass\Models;

use Illuminate\Database\Eloquent\Model;

class WalletPassState extends Model
{
    protected $guarded = [];

    protected $casts = [
        'expires_at' => 'datetime',
        'localized_strings' => 'array',
        'revoked' => 'boolean',
        'redeemed' => 'boolean'
    ];

    public function status(): string
    {
        if ($this->revoked) return 'REVOKED';
        if ($this->redeemed) return 'REDEEMED';
        if ($this->expires_at && $this->expires_at->isPast()) return 'EXPIRED';
        return 'ACTIVE';
    }

    public function logs()
    {
        return $this->hasMany(PassLog::class);
    }
}