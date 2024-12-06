<?php

namespace Modules\IranProvinces\Providers;

use Illuminate\Support\ServiceProvider;

class IranProvincesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
        $this->loadViewsFrom(__DIR__.'/../Resources/views', 'iranprovinces');
        $this->loadRoutesFrom(__DIR__.'/../Routes/web.php');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // اضافه کردن منوی ماژول به منوی اصلی
        $this->app->booted(function () {
            $menu = $this->app['menu'];
            $menu->add([
                'text' => 'مدیریت مناطق',
                'icon' => 'fa fa-map-marker',
                'order' => 500,
                'submenu' => [
                    [
                        'text' => 'استان‌ها',
                        'url' => route('provinces.index'),
                        'icon' => 'fa fa-circle-o'
                    ],
                    [
                        'text' => 'شهرها',
                        'url' => route('cities.index'),
                        'icon' => 'fa fa-circle-o'
                    ]
                ]
            ]);
        });
    }
}