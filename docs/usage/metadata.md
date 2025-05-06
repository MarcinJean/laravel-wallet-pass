# 🧾 Metadata and Contextual Logging

This guide explains how to attach contextual metadata to pass lifecycle events like creation, redemption, download, and rejection.

---

## 🎯 What is Metadata?

Metadata allows you to attach additional details (like kiosk ID, user agent, or source system) to any `pass_logs` entry. It's stored as JSON and fully optional.

---

## 💡 When Is It Useful?

- Logging kiosk or advisor ID
- Identifying API vs kiosk traffic
- Tagging test vs production traffic
- Debugging redemption or expiration edge cases

---

## 🧰 How to Use `setLogMeta()`

```php
WalletPass::setLogMeta([
    'kiosk_id' => 'FOYER-01',
    'env' => app()->environment(),
]);
```

Set this **once per request or job**, and all log entries will inherit the metadata.

---

## 🪪 Which Events Support Metadata?

All actions routed through `PassTracker::log()`:

| Event Name                   | Supports Metadata |
|------------------------------|-------------------|
| `created`                    | ✅ Yes |
| `redeemed`                   | ✅ Yes |
| `revoked`                    | ✅ Yes |
| `refreshed`                  | ✅ Yes |
| `downloaded`                 | ✅ Yes |
| `rejected_duplicate_download`| ✅ Yes |
| `registered` (Apple)         | ✅ Yes |

---

## 🧱 How It's Stored

In the `pass_logs` table:

```json
{
  "kiosk_id": "FOYER-01",
  "env": "production"
}
```

Field: `meta`  
Type: JSON (nullable)

---

## 🔐 Is It Required?

No — if you never call `setLogMeta()`, nothing changes. Your logs will still work as expected.

---

## 🔗 Next Steps

- [Logging details →](../advanced/logging.md)
- [Pass status logic →](../usage/redeem-pass.md)