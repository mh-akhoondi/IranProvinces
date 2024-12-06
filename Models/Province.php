<?php

namespace Modules\IranProvinces\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected \ = ['name', 'is_active'];
    
    protected \ = [
        'is_active' => 'boolean'
    ];

    public function cities()
    {
        return \->hasMany(City::class);
    }

    public function scopeActive(\)
    {
        return \->where('is_active', true);
    }
}
