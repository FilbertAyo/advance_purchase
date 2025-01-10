<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_name',
        'description',
        'cost',
        'sales',
        'category',
        'brand',
        'code',
        'expire_date',
        'created_by',
        'image'
    ];
}
