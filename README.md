# Laravel Wallet Pass

A Laravel package for generating and managing digital wallet passes (Apple Wallet & Google Wallet) with expiration, redemption, push updates, signed download links, and full audit logging.

---

## 🔧 Installation

```bash
composer require your-vendor/laravel-wallet-pass
php artisan walletpass:install
```

This publishes:
- `config/walletpass.php`
- Unified migration
- (Optional) Nova resources and metrics

---

## 🚀 Features

- ✅ Apple & Google Wallet support
- ✅ Barcode generation with prefix enforcement
- ✅ Signed + one-time download URLs
- ✅ Full pass lifecycle logging (meta included)
- ✅ Redeem, revoke, refresh logic
- ✅ Scheduled expiration
- ✅ Nova metrics & admin views (optional)
- ✅ Developer-safe public API
- ✅ Blade + Vue wallet buttons (deferred creation)

---

## ⚙️ Configuration

Edit `config/walletpass.php` to enable or disable features:
- Signed URLs
- One-time downloads
- Nova integration
- Barcode format

---

## ✏️ Usage

```php
// Create a coupon
$pass = WalletPass::createCoupon([
    'wallet_type' => 'apple',
    'prefix' => 'FREE',
    'label' => 'Free Oil Change',
    'value' => '$0',
]);

// Get signed download URL
$url = WalletPass::downloadUrl($pass);

// Redeem it later
WalletPass::redeem($pass->serial);
```

---

## 📚 Documentation

Detailed docs coming soon in `/docs` — covering:
- API reference
- UI integration
- Extending metadata
- Pass lifecycle examples

---

## ❌ Out of Scope

This package does **not** handle:
- Offer rules or templates
- Email/sms delivery
- Rate limiting
- Manual coupon creation via Nova

Business logic is left to the host application.

---

## 🪪 License

Licensed under the [MIT License](LICENSE).