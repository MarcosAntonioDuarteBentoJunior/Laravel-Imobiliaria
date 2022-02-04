<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Realty extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'rooms', 'bedrooms', 'bathrooms', 'parking', 'area', 'value', 'description', 'rented', 'sold', 'reserved', 'user_id', 'usage_id', 'category_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function usage(){
        return $this->belongsTo(Usage::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function photos(){
        return $this->hasMany(RealtyPhoto::class);
    }

    public function adress(){
        return $this->hasOne(Adress::class);
    }
}
