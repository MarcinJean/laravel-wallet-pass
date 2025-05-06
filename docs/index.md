# Laravel Wallet Pass

**Laravel Wallet Pass** is a framework-agnostic package for managing digital coupons and loyalty cards in Apple Wallet and Google Wallet — built to be developer-friendly, transparent, and secure.

It provides:

- A clean abstraction over Apple `.pkpass` and Google Wallet APIs
- Full lifecycle control: create, redeem, revoke, expire
- Secure delivery via signed and one-time URLs
- Logging and state tracking for every pass issued
- Optional Nova metrics and admin visibility

---

## 📦 Philosophy

This package focuses on **clean separation of concerns**:

- **We handle pass creation** — not what a coupon *means*.
- **You handle offer logic** — not barcode security or wallet rules.
- **We log state transitions and downloads** — you decide what counts as redemption.
- **We support Blade, Vue, Nova** — but never force them.

---

## 🧭 Who Is This For?

- Laravel developers building promotional campaigns
- Dealerships issuing internal coupons at kiosks
- Web apps sending one-time use loyalty rewards
- Admin teams that need accountability and audit logging

This is not a full coupon engine. It's the tool you build it with.

---

## 📚 Where to Go Next

- [`installation.md`](./installation.md) – install, migrate, configure
- [`usage/create-pass.md`](./usage/create-pass.md) – generate your first pass
- [`integration/blade.md`](./integration/blade.md) – use Blade buttons
- [`integration/nova.md`](./integration/nova.md) – set up admin insights