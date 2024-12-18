<?php
namespace Modules\IranProvinces\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $fillable = ['name', 'is_active'];
    
    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}