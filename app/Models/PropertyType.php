<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyType extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Global scope - শুধু active data দেখাবে by default
     */
    protected static function booted()
    {
        static::addGlobalScope('active', function ($query) {
            $query->where('status', 'active');
        });
    }

    /**
     * Scope: শুধু active data
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

}
