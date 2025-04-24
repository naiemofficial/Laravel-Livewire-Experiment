<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cookie extends Model
{
    //
    protected $fillable = [
        'name',
        'value',
        'expires_at'
    ];
}
