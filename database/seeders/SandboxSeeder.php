<?php

declare(strict_types=1);

namespace Shopper\Sandbox\Seeders;

use Illuminate\Database\Seeder;
use Shopper\Core\Database\Seeders\ShopperSeeder;
use Shopper\Database\Seeders\AuthTableSeeder;

class SandboxSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AuthTableSeeder::class,
            ShopperSeeder::class,
            StoreConfigSeeder::class,
            BrandSeeder::class,
            CategorySeeder::class,
            CollectionSeeder::class,
            AttributeSeeder::class,
            ProductSeeder::class,
            PaymentMethodSeeder::class,
            ZoneSeeder::class,
            TaxSeeder::class,
            CustomerSeeder::class,
            ReviewSeeder::class,
            OrderSeeder::class,
        ]);
    }
}
