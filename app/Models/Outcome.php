<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

use App\Models\Branch;
use App\Models\Store;

class Outcome extends Model
{
    use HasFactory;

    public function branches()
    {
        return $this->belongsTo(Branch::class,'branch_id');
    }

    public function stores()
    {
        return $this->belongsTo(Store::class,'store_id');
    }
    
    public function getDateAttribute()
    {
        return Carbon::parse($this->created_at)->translatedFormat('D d/m');
    }
}
