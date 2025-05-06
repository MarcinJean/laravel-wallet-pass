# ⬇️ Downloading a Wallet Pass

This guide covers how to securely serve passes to users, including support for signed URLs and one-time-use enforcement.

---

## 🔗 Generate Download URL

Use this helper to generate a secure download link:

```php
$url = WalletPass::downloadUrl($pass);
```

This will:
- Use a temporary signed route (if enabled)
- Fallback to a basic route if signed URLs are disabled
- Respect one-time download rules if configured

---

## 🔐 Signed URLs (Default)

To enforce secure downloads:

```php
'signed_download_urls' => true
```

Enable in `config/walletpass.php`. Links will expire after `download_url_lifetime` minutes.

---

## 🚫 One-Time Use Downloads

To prevent re-use of links:

```php
'one_time_download' => true
```

Requires `signed_download_urls = true`. A pass can only be downloaded once.

---

## 🧠 Behind the Scenes

- Download attempts are logged via `pass_logs`
- Second attempts (if blocked) are also logged with event: `rejected_duplicate_download`
- Apple Wallet downloads serve `.pkpass`
- Google Wallet redirects to platform-specific `save` URL

---

## 📲 Deferred Generation

To delay pass creation until the user clicks "Add to Wallet", POST to:

```http
POST /wallet/generate
```

Include:
- `wallet_type`
- `prefix`, `label`, `value`
- (optional) `fingerprint`

Receive:
```json
{ "url": "https://..." }
```

---

## 🔗 Next Steps

- [Blade or Vue button integration →](../integration/blade.md)
- [Audit logging structure →](../advanced/logging.md)