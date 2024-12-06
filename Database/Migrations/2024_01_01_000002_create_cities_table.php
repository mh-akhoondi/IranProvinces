// Database/Migrations/2024_01_01_000002_create_cities_table.php

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitiesTable extends Migration
{
    /**
     * اجرای مهاجرت
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();                    // شناسه یکتا
            $table->foreignId('province_id') // ارتباط با جدول استان‌ها
                  ->constrained()
                  ->onDelete('cascade');
            $table->string('name');          // نام شهر
            $table->boolean('is_active')     // وضعیت فعال/غیرفعال
                  ->default(true);
            $table->timestamps();            // created_at و updated_at
            
            // ایجاد ایندکس‌ها
            $table->index('name');
            $table->index('is_active');
        });
    }

    /**
     * برگرداندن مهاجرت
     */
    public function down()
    {
        Schema::dropIfExists('cities');
    }
}