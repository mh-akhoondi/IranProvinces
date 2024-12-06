<?php

namespace Modules\IranProvinces\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\IranProvinces\Models\Province;
use Modules\IranProvinces\Models\City;

class IranProvincesSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        
        City::query()->delete();
        Province::query()->delete();
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        foreach ($this->provinces as $provinceName => $cities) {
            $province = Province::create([
                'name' => $provinceName,
                'is_active' => true
            ]);

            foreach ($cities as $cityName) {
                City::create([
                    'province_id' => $province->id,
                    'name' => $cityName,
                    'is_active' => true
                ]);
            }
        }
    }
}