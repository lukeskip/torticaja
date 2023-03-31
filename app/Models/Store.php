<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Branch;
use App\Models\User;

class Store extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsTo(User::class,'store_id');
    }
    
    public function branches()
    {
        return $this->hasMany(Branch::class,'store_id');
    }

    public function outcomes()
    {
        return $this->hasMany(Outcome::class,'store_id');
    }

    public function incomes()
    {
        return $this->hasMany(Income::class,'store_id');
    }
}
