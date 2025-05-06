# 🛠 Creating a Wallet Pass

Creating a wallet-compatible coupon or loyalty card is simple with `WalletPass::createCoupon()`.

This guide shows how to securely generate a pass and control its expiration, barcode, and metadata.

---

## 🧾 Basic Usage

```php
use MarcinJean\WalletPass\Facades\WalletPass;

$pass = WalletPass::createCoupon([
    'wallet_type' => 'apple', // or 'google'
    'prefix' => 'FREE',
    'label' => 'Free Oil Change',
    'value' => '$0',
]);
```

This will:
- Generate a unique serial and barcode (e.g. `FREE123456`)
- Set default expiration (30 days unless overridden)
- Create a record in `wallet_pass_states`

---

## 📅 Custom Expiration

You can pass a custom expiration date using `expires_at`:

```php
'expires_at' => now()->addDays(45)
```

---

## 🧠 Preventing Duplicates

If you're generating passes based on device, email, or kiosk:

```php
'fingerprint' => $kioskOrUserHash
```

This prevents duplicate passes unless the original is revoked.

---

## 🈳 Localization (Optional)

Pass localized display strings using `localized_strings`:

```php
'localized_strings' => [
    'en' => ['label' => 'Free Oil Change', 'value' => '$0'],
    'es' => ['label' => 'Cambio de aceite gratis', 'value' => '0 $']
]
```

These are supported on both Apple and Google and will be preserved on updates.

---

## 🧾 Metadata Logging

To associate metadata with logs:

```php
WalletPass::setLogMeta(['kiosk_id' => 'FRONT-A'])->createCoupon([...]);
```

This metadata will be stored in the `pass_logs` system when the pass is created.

---

## 🔗 Next Steps

- [Download and redeem pass →](./download-pass.md)
- [Audit logging and metadata →](../advanced/logging.md)