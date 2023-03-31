<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Income extends Model
{
    use HasFactory;

    public function stores()
    {
        return $this->belongsTo(Store::class,'store_id');
    }

    public function getDateAttribute()
    {
        return Carbon::parse($this->created_at)->translatedFormat('D d/m');
    }
}
