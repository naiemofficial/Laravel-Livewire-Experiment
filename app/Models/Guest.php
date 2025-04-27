<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    //
    protected $fillable = ['name', 'cookie_id'];

    public function cookie(){
        return $this->belongsTo(Cookie::class);
    }
}
