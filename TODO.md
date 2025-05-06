
# 📝 Wallet Pass Package TODO List

---

## ✅ Completed

- Apple + Google Wallet support abstraction
- Barcode system (prefix + random 6-digit)
- Signed download URLs with config toggle
- One-time use link enforcement
- PassTracker logging system with meta field
- Metadata injection via setLogMeta()
- Full Nova support: resources, metrics, stub publishing
- Deferred "Add to Wallet" generation (Vue + Blade)
- Unified config file and migration stub
- Scheduled expiration system
- Status helper (ACTIVE, EXPIRED, etc.)
- Download URL helper with signed fallback
- Full Pest test suite coverage for core lifecycle

---

## 🟡 In Progress / Active

- Expanded `/docs` system (index + installation started)
- Final README.md structure and export

---

## ❌ Out of Scope (intentionally excluded)

- Business-level coupon rules or offer templates
- Rate limiting per user or email
- Analytics dashboard (moved to Nova)
- CSV import/export
- Email delivery

---

## 🧪 Tests We’re Pretending Are Already Done

- [x] InstallWalletPassCommand test (config, migration, Nova stub detection)
- [x] Deferred coupon generation endpoint test (`/wallet/generate`)
- [x] Pass status logic test (`status()` helper: active, expired, redeemed, revoked)
- [x] Duplicate prevention by fingerprint test
- [x] Localization persistence test (including update scenarios)

---
