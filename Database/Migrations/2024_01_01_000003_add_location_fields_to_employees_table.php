// Database/Migrations/2024_01_01_000003_add_location_fields_to_employees_table.php
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLocationFieldsToEmployeesTable extends Migration
{
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
            // محل تولد
            $table->foreignId('birth_province_id')
                  ->nullable()
                  ->constrained('provinces')
                  ->nullOnDelete();
            
            $table->foreignId('birth_city_id')
                  ->nullable()
                  ->constrained('cities')
                  ->nullOnDelete();

            // محل سکونت
            $table->foreignId('residence_province_id')
                  ->nullable()
                  ->constrained('provinces')
                  ->nullOnDelete();
            
            $table->foreignId('residence_city_id')
                  ->nullable()
                  ->constrained('cities')
                  ->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropForeign(['birth_province_id']);
            $table->dropForeign(['birth_city_id']);
            $table->dropForeign(['residence_province_id']);
            $table->dropForeign(['residence_city_id']);
            
            $table->dropColumn([
                'birth_province_id',
                'birth_city_id',
                'residence_province_id',
                'residence_city_id'
            ]);
        });
    }
}