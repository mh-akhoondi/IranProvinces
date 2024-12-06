// Database/Migrations/2024_01_01_000001_create_provinces_table.php

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvincesTable extends Migration
{
    /**
     * اجرای مهاجرت
     */
    public function up()
    {
        Schema::create('provinces', function (Blueprint $table) {
            $table->id();                    // شناسه یکتا
            $table->string('name');          // نام استان
            $table->boolean('is_active')     // وضعیت فعال/غیرفعال
                  ->default(true);
            $table->timestamps();            // created_at و updated_at
            
            // ایجاد ایندکس برای جستجوی سریع‌تر
            $table->index('name');
            $table->index('is_active');
        });
    }

    /**
     * برگرداندن مهاجرت
     */
    public function down()
    {
        Schema::dropIfExists('provinces');
    }
}