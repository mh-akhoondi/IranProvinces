<?php
namespace Modules\IranProvinces\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['province_id', 'name', 'is_active'];
    
    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}