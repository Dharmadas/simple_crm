<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerLog extends Model
{
    public $fillable = ['name', 'email', 'phone', 'user_id'];
}
