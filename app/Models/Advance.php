<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advance extends Model
{
    use HasFactory;
    protected $fillable = [
        'application_id',
        'added_amount',
        'outstanding',
        'updated_by'
    ];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }

}
