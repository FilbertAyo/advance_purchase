<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'item_id',
        'price',
        'serial_number',
        'paid_amount',
        'outstanding',
        'withheld_amount',
        'status',
        'delivery_status',
        'reason',
        'refund_amount',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }
    public function item()
{
    return $this->belongsTo(Item::class);
}

}
