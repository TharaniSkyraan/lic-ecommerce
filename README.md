# License Installation 

This is library for license installation in project

# Composer

```bash
composer require tharasky/lic-ecommerce

```

# Migrate Tables

create database name as strip_payment and run artisan command

```bash
php artisan migrate

```

# Service Provider

In app.php include inside of provider

```bash
Tharasky\LicEcommerce\LicEcommerceServiceProvider::class,

```

# Middleware 

In kernal.php include inside of middlewareGroup

```bash
\Tharasky\LicEcommerce\Http\Middleware\ValidateLicEcommerce::class,

```
