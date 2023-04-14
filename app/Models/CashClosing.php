<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashClosing extends Model
{
    use HasFactory;

    protected $fillable = [
        'dough',
        'dough_cold',
        'dough_leftover',
        'flour',
        'tortilla_leftover',
        'cash',
        'gas'              
    ];
}
