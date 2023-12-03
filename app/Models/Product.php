<?php

namespace App\Models;
use App\Models\Kind;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Cart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function kind(){
        return $this->belongsTo(Kind::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function carts(){
        return $this->belongsToMany(Cart::class, 'cart_products', 'product_id', 'cart_id');
    }
}
