# ⚡ ScaleKit – Scalable Laravel Starter Kit for APIs

[![License: MIT](https://img.shields.io/badge/License-MIT-blue.svg)](LICENSE)
[![Packagist](https://img.shields.io/packagist/v/aaqib/scalekit.svg)](https://packagist.org/packages/aaqib/scalekit)
[![Downloads](https://img.shields.io/packagist/dt/aaqib/scalekit.svg)](https://packagist.org/packages/aaqib/scalekit)

ScaleKit is a **Laravel package** that provides a production-ready API starter kit with:

- 🔑 Authentication with [Laravel Sanctum](https://laravel.com/docs/sanctum)
- 🧩 Configurable & extendable (publish config/migrations)
- 🚀 API-first development (no Blade scaffolding required)
- 🔗 OAuth (Google, GitHub, Twitter, Facebook) – *coming soon*
- 🛡️ Role & Permission Management ([Spatie Laravel Permission](https://spatie.be/docs/laravel-permission)) – optional – *coming soon*
- 🌍 Multi-tenant support (single DB mode) – optional – *coming soon*

👉 The goal: **Save developers from reinventing auth & boilerplate every time.**

---

## 📦 Installation

Require the package via Composer:

```bash
composer require aaqib/scalekit:@dev
```

---

## ⚙️ Publish Package Assets

You can publish assets individually:

```bash
# Publish config
php artisan vendor:publish --tag=scalekit-config

# Publish migrations
php artisan vendor:publish --tag=scalekit-migrations

# Publish seeders
php artisan vendor:publish --tag=scalekit-seeders

# Publish Sanctum migrations
php artisan vendor:publish --tag=scalekit-sanctum
```

Or publish **everything at once**:

```bash
php artisan vendor:publish --tag=scalekit-install
```

Then run migrations:

```bash
php artisan migrate
```

---

## 🔑 Authentication (Sanctum)

ScaleKit uses **Laravel Sanctum** for issuing API tokens.

| Method | Endpoint        | Description         |
| ------ | --------------- | ------------------- |
| POST   | `/api/register` | Register a new user |
| POST   | `/api/login`    | Login user          |
| POST   | `/api/logout`   | Logout user         |
| GET    | `/api/profile`  | Get user profile    |

### Example response from login/register

```json
{
  "token": "1|mHHOIwVVnzCggtsb00bdIPbnSJOFMiKs3FWSM01kde2d3e43"
}
```

### Use it in headers for subsequent requests

```http
Authorization: Bearer <your-token>
```

---

## 🔗 OAuth (Coming Soon 🚧)

Support for **Google, GitHub, Twitter, and Facebook** authentication is included in the codebase but not fully tested yet.

Planned flow:

1. Request a redirect URL → `/api/oauth/redirect/{provider}`  
2. Get callback from provider → `/api/oauth/callback/{provider}`  
3. ScaleKit issues a Sanctum token

---

## 🌍 Multi-Tenancy (Optional)

Enable **single-DB multi-tenant mode** by updating `.env`:

```env
SCALEKIT_TENANCY=true
```

Tenants can be resolved by:

- Request header (`X-Tenant-ID`)
- Or subdomain mapping (*planned*).

---

## 🛡️ Roles & Permissions (Optional)

If enabled in config:

```php
'roles' => [
    'enabled' => true,
],
```

ScaleKit integrates with **[Spatie Laravel Permission](https://spatie.be/docs/laravel-permission/)**.  
You’ll have full role & permission APIs out-of-the-box.

---

## 📂 Config

Published config file: `config/scalekit.php`

```php
return [
    'tenant' => [
        'enabled' => env('SCALEKIT_TENANCY', false),
        'tenant_header' => 'X-Tenant-ID',
        'tenant_column' => 'tenant_id',
    ],

    'oauth_providers' => [
        'google'   => env('SCALEKIT_PROVIDER_GOOGLE', true),
        'github'   => env('SCALEKIT_PROVIDER_GITHUB', true),
        'twitter'  => env('SCALEKIT_PROVIDER_TWITTER', false),
        'facebook' => env('SCALEKIT_PROVIDER_FACEBOOK', false),
    ],

    'roles' => [
        'enabled' => env('SCALEKIT_ROLES', true),
    ],

    'user_model' => Aaqibshahzad\Scalekit\Models\User::class,
];
```

---

## 🔮 Roadmap

- ✅ Sanctum API authentication  
- ✅ User, sessions, password resets migrations  
- ✅ Config publishing  
- ✅ Optional Spatie roles & tenancy  
- 🚧 OAuth providers (Google, GitHub, Twitter, Facebook)  
- 🚧 Team/Organization support  
- 🚧 Multi-DB tenancy  

---

## 🛠️ Contributing

Contributions are welcome! 🎉  

1. Fork the repo  
2. Create your feature branch (`git checkout -b feature/new-thing`)  
3. Commit changes (`git commit -m 'Added some new thing'`)  
4. Push (`git push origin feature/new-thing`)  
5. Open a Pull Request  

---

## 📜 License

ScaleKit is open-sourced under the [MIT License](LICENSE).