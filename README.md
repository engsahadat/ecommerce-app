# 🛒 Ecommerce App - Multi-Login SSO System

## Overview

This is the **Ecommerce Application** component of a Multi-Login Single Sign-On (SSO) system. When users log into this app, they are automatically logged into the **Foodpanda App** without re-entering credentials.

## Quick Start

### 1. Install Dependencies
```bash
composer install
```

### 2. Configure Environment
```bash
cp .env.example .env
php artisan key:generate
```

Update `.env`:
```env
DB_DATABASE=multi_login_sso
SESSION_DRIVER=database
FOODPANDA_APP_URL=http://localhost/ZaviSoft/foodpanda-app/public
```

### 3. Setup Database
```bash
php artisan migrate
php artisan db:seed
```

### 4. Test
- Visit: http://localhost/ZaviSoft/ecommerce-app/public
- Login: demo@example.com / password
- Click "Go to Foodpanda App" to test SSO!

## Features

✅ User Registration & Login
✅ SSO Token Generation
✅ Automatic Cross-App Authentication
✅ Modern Responsive UI
✅ Session Management
✅ Secure Token Handling

## SSO Integration

This app generates SSO tokens when users log in, allowing seamless authentication across both applications. The SSO system uses:

- **Shared Database:** `multi_login_sso`
- **Session Driver:** Database (shared sessions)
- **Token Expiry:** 24 hours
- **Security:** Bcrypt passwords, CSRF protection

## Documentation

📚 **Complete Documentation Available:**
- `../SSO_DOCUMENTATION.md` - Full technical documentation
- `../SETUP_GUIDE.md` - Quick setup instructions
- `../FINAL_SETUP_INSTRUCTIONS.md` - Step-by-step guide

## Tech Stack

- Laravel 11.x
- PHP 8.1+
- MySQL 5.7+
- Blade Templates
- Custom SSO Service

## Related App

🍔 **Foodpanda App:** Located at `../foodpanda-app`

Both apps work together to provide seamless multi-login functionality.

---

**Status:** Production Ready ✅
**Last Updated:** February 24, 2026

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
"# ecommerce-app" 
