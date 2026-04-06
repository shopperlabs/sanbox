<?php

declare(strict_types=1);

namespace Shopper\Sandbox;

use Illuminate\Support\ServiceProvider;

class SandboxServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                $this->storagePath() => storage_path('app/public'),
            ], 'sandbox-storage');
        }
    }

    public static function basePath(string $path = ''): string
    {
        return dirname(__DIR__).($path !== '' ? '/'.$path : '');
    }

    public static function storagePath(string $path = ''): string
    {
        return static::basePath('storage'.($path !== '' ? '/'.$path : ''));
    }
}
