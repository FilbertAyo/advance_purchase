<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'item_name',
        'customer_name',
        'price',
        'serial_number',
        'paid_amount',
        'outstanding',
        'created_by',
        'status',
        'delivery_status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'customer_id', 'id'); 
    }
}
