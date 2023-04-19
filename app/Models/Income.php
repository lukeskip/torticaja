<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Income extends Model
{
    use HasFactory;

    public function orders()
    {
        return $this->belongsTo(Order::class,'order_id');
    }

    public function products()
    {
        return $this->belongsTo(Product::class,'product_id');
    }

    public function stores()
    {
        return $this->belongsTo(Store::class,'store_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function getDateAttribute()
    {
        return Carbon::parse($this->created_at)->translatedFormat('D d/m');
    }

    public function getTimeAttribute()
    {
        return Carbon::parse($this->created_at)->translatedFormat('m:h');
    }
}
