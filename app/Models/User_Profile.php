<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_Profile extends Model
{
    protected $fillable = [
        'user_id',
        'ward',
        'district',
        'street',
        'city',
        'gender',
        'birth_date',
        'id_type',
        'id_number',
        'id_attachment',
        'employment_status',
        'occupation',
        'organization',
        'profile_image',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function ward()
    {
        return $this->belongsTo(Ward::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
