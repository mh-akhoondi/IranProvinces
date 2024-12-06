<?php
// Providers/IranProvincesServiceProvider.php

namespace Modules\IranProvinces\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\IranProvinces\Models\Province;

class IranProvincesServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'IranProvinces';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'iranprovinces';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));

        // اضافه کردن فیلدهای استان و شهر به فرم کارمندان
        $this->app['events']->listen('employee-form.after-basic-fields', function () {
            return view('iranprovinces::hooks.employee_form_fields', [
                'provinces' => Province::active()->orderBy('name')->get()
            ]);
        });

        // اضافه کردن اسکریپت‌های مورد نیاز
        $this->app['events']->listen('admin.footer-scripts', function () {
            return view('iranprovinces::scripts.location-fields');
        });

        // اضافه کردن فیلدهای جدید به مدل Employee
        $this->extendEmployeeModel();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path($this->moduleName, 'Config/config.php') => config_path($this->moduleNameLower . '.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path($this->moduleName, 'Config/config.php'),
            $this->moduleNameLower
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/' . $this->moduleNameLower);

        $sourcePath = module_path($this->moduleName, 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ], ['views', $this->moduleNameLower . '-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/' . $this->moduleNameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
        } else {
            $this->loadTranslationsFrom(module_path($this->moduleName, 'Resources/lang'), $this->moduleNameLower);
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    /**
     * اضافه کردن فیلدهای جدید به مدل Employee
     */
    private function extendEmployeeModel()
    {
        $employeeModel = config('auth.providers.employees.model', \App\Models\Employee::class);

        $employeeModel::resolveRelationUsing('birthProvince', function ($employeeModel) {
            return $employeeModel->belongsTo(Province::class, 'birth_province_id');
        });

        $employeeModel::resolveRelationUsing('birthCity', function ($employeeModel) {
            return $employeeModel->belongsTo(City::class, 'birth_city_id');
        });

        $employeeModel::resolveRelationUsing('residenceProvince', function ($employeeModel) {
            return $employeeModel->belongsTo(Province::class, 'residence_province_id');
        });

        $employeeModel::resolveRelationUsing('residenceCity', function ($employeeModel) {
            return $employeeModel->belongsTo(City::class, 'residence_city_id');
        });
    }

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (\Config::get('view.paths') as $path) {
            if (is_dir($path . '/modules/' . $this->moduleNameLower)) {
                $paths[] = $path . '/modules/' . $this->moduleNameLower;
            }
        }
        return $paths;
    }
}