<?php

namespace Modules\IranProvinces\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
{
    use HasFactory;
    protected \ = ['province_id', 'name', 'is_active'];
    
    protected \ = [
        'is_active' => 'boolean'
    ];

    public function province()
    {
        return \->belongsTo(Province::class);
    }

    public function scopeActive(\)
    {
        return \->where('is_active', true);
    }
}
