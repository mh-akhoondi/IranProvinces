<?php

// Models/Province.php
namespace Modules\IranProvinces\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $fillable = ['name', 'is_active'];

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}

// Models/City.php
namespace Modules\IranProvinces\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['province_id', 'name', 'is_active'];

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
