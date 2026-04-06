<?php

declare(strict_types=1);

namespace Shopper\Sandbox\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Shopper\Sandbox\SandboxServiceProvider;

abstract class AbstractSeeder extends Seeder
{
    protected function getSeedData(string $file): Collection
    {
        return collect(json_decode(
            File::get(SandboxServiceProvider::basePath("database/seeders/data/{$file}.json"))
        ));
    }

    protected function imagePath(string $folder, string $filename): string
    {
        return SandboxServiceProvider::basePath("database/seeders/data/images/{$folder}/{$filename}");
    }
}
