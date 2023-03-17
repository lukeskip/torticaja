<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function categories()
    {
        return $this->belongsToMany(Category::class,'product_category');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class,'order_product');
    }

    public function incomes()
    {
        return $this->hasMany(Income::class,'product_id');
    }

    public function getSelectedCategoriesAttribute()
    {
        return $categories = $this->categories->map(function ($item, $key) {
            return $item->slug;
        });
        
    }
}
