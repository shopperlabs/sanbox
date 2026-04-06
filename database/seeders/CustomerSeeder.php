<?php

declare(strict_types=1);

namespace Shopper\Sandbox\Seeders;

use Shopper\Sandbox\Seeders\Concerns\WithProgressBar;
use Illuminate\Database\Seeder;
use Shopper\Core\Models\Address;
use Shopper\Core\Models\Zone;

class CustomerSeeder extends Seeder
{
    use WithProgressBar;

    public function run(): void
    {
        $zoneCountryIds = Zone::query()
            ->where('is_enabled', true)
            ->with('countries')
            ->get()
            ->flatMap(fn (Zone $zone) => $zone->countries->pluck('id'))
            ->unique()
            ->values();

        if ($zoneCountryIds->isEmpty()) {
            $this->command->warn('No countries found in zones. Please run ZoneSeeder first.');

            return;
        }

        $this->command->warn(PHP_EOL.'Creating customers...');

        $userModel = config('auth.providers.users.model');

        $this->withProgressBar(100, function () use ($zoneCountryIds, $userModel) {
            $customer = $userModel::factory()
                ->has(
                    Address::factory()
                        ->count(rand(1, 3))
                        ->state(fn () => ['country_id' => $zoneCountryIds->random()])
                )
                ->create();

            $customer->assignRole(config('shopper.admin.roles.user'));

            return collect([$customer]);
        });

        $this->command->info('Customers created successfully.');
    }
}
