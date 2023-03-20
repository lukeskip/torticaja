<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Branch;

class Store extends Model
{
    use HasFactory;

    public function branches()
    {
        return $this->hasMany(Branch::class,'store_id');
    }
}
