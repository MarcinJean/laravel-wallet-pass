# 🎟 Redeeming, Revoking, and Refreshing Passes

This guide covers how to redeem a pass when it's used, revoke a pass if needed, and trigger refresh logic for Apple or Google Wallet.

---

## ✅ Redeem a Pass

Redemption marks the pass as used and logs the action:

```php
WalletPass::redeem($serial);
```

This will:
- Set `redeemed = true`
- Log the `redeemed` event in `pass_logs`
- Push or patch the pass if supported by the platform

You can safely call this from kiosk check-in, advisor tool, or admin action.

---

## ⛔ Revoke a Pass

Revoking a pass disables it without marking it as used:

```php
WalletPass::revoke($serial);
```

This sets `revoked = true`, preventing further redemption or downloads.

---

## 🔁 Refresh a Pass (Manual Push)

You can trigger a refresh for a given serial — this tells Apple/Google to update the user's wallet pass with the latest state.

```php
WalletPass::refresh($serial);
```

Used after changes such as:
- Localization updates
- Expiration changes
- Redemption/revocation

---

## 🔍 Check Pass Status

Get the normalized status:

```php
$status = $pass->status(); // 'ACTIVE', 'REDEEMED', 'EXPIRED', 'REVOKED'
```

This is used internally for downloads and admin views.

---

## 🧾 Log Metadata on Actions

Use `setLogMeta()` once before calling any action:

```php
WalletPass::setLogMeta(['kiosk_id' => 'STIVERS-01'])->redeem($serial);
```

---

## 🔗 Next Steps

- [Generate download URL →](./download-pass.md)
- [Audit trail and logging →](../advanced/logging.md)