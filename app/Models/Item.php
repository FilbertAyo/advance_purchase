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
        'credit_price',
        'sales',
        'category',
        'brand',
        'code',
        'expire_date',
        'created_by',
        'image'
    ];

    public function productImages()
    {
        return $this->hasMany(Product_Image::class, 'item_id');
    }
}
