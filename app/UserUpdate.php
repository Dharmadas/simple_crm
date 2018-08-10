<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserUpdate extends Model
{
    protected $fillable = [
        'customer_id',
        'user_id',
        'disposition_id',
        'message'
    ];
}
