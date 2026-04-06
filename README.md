# Shopper Sandbox

Pre-built demo data and shared storage for developing with [Laravel Shopper](https://laravelshopper.dev). Clone this repository into your project directory and get a fully populated store — products, categories, brands, collections, orders, customers, and images — in a single command.

## What's inside

- **14 seeders** covering the full Shopper data model (brands, categories, collections, attributes, products with variants, payment methods, zones, taxes, customers, reviews, orders)
- **JSON fixtures** with realistic product data, descriptions, and pricing
- **Source images** for products, brands, categories, and collections
- **Shared storage** directory so multiple projects can reference the same uploaded media

## Requirements

- PHP 8.2+
- A Laravel project with [Shopper](https://github.com/shopperlabs/shopper) installed

## Setup

Clone this repository next to your Laravel project:

```
your-projects/
├── sandbox/          ← this repo
└── your-laravel-app/
```

Add the path repository and require the package in your Laravel project's `composer.json`:

```json
{
  "repositories": [
    {
      "type": "path",
      "url": "../sandbox",
      "options": { "symlink": true }
    }
  ],
  "require-dev": {
    "shopper/sandbox": "@dev"
  }
}
```

Then run:

```bash
composer update shopper/sandbox
```

## Usage

### Seeding the database

Call the `SandboxSeeder` from your `DatabaseSeeder`:

```php
use Shopper\Sandbox\Seeders\SandboxSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(SandboxSeeder::class);
    }
}
```

Then run:

```bash
php artisan db:seed
```

This creates an admin user (`admin@laravelshopper.dev` / `demo.Shopper@2026!`) and populates the entire store catalog.

### Shared storage

The `storage/` directory in this package is designed to be shared across multiple projects. This way, if you switch between starter kits or frontends using the same database, uploaded images remain accessible.

Add a `storage:link` script to your project's `composer.json`:

```json
{
  "scripts": {
    "storage:link": [
      "rm -rf storage/app/public",
      "ln -sf ../../sandbox/storage storage/app/public",
      "@php artisan storage:link"
    ]
  }
}
```

Adjust the relative path (`../../sandbox/storage`) based on where you cloned this repo relative to your project. Then run:

```bash
composer storage:link
```

### Running individual seeders

You can also run specific seeders directly:

```bash
php artisan db:seed --class="Shopper\Sandbox\Seeders\BrandSeeder"
php artisan db:seed --class="Shopper\Sandbox\Seeders\ProductSeeder"
```

## Demo data overview

| Seeder | What it creates |
|---|---|
| `StoreConfigSeeder` | Admin user, store settings, default inventory |
| `BrandSeeder` | Brands with logos |
| `CategorySeeder` | Categories with children and images |
| `CollectionSeeder` | Collections with rules and images |
| `AttributeSeeder` | Attributes (size, color, etc.) with values |
| `ProductSeeder` | Products with variants, prices, stock, images, tags, and related products |
| `PaymentMethodSeeder` | Stripe payment method |
| `ZoneSeeder` | Shipping zones with carriers and options |
| `TaxSeeder` | Tax zones and rates |
| `CustomerSeeder` | 100 customers with addresses |
| `ReviewSeeder` | 100 product reviews |
| `OrderSeeder` | 50 orders with items and addresses |

## License

MIT
