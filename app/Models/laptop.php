<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laptop extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'brand',
        'model',
        'price',
        'selling_price',
    ];
}
