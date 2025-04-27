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

    public function user(){
        return $this->hasMany(Guest::class, 'cookie_id')->first();
    }

    public function guest(){
        return $this->user();
    }
}
