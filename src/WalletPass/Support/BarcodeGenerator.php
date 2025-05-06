<?php

namespace MarcinJean\WalletPass\Support;

class BarcodeGenerator
{
    public static function generate(string $prefix): string
    {
        $prefix = strtoupper($prefix);
        if (!preg_match('/^[A-Z]{4}$/', $prefix)) {
            throw new \InvalidArgumentException("Prefix must be 4 letters.");
        }

        return $prefix . rand(100000, 999999);
    }
}