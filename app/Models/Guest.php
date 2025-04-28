<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \App\Models\Cookie;

class Guest extends Model
{
    public static string $cookie_name = 'guest_session';
    protected $fillable = ['name', 'cookie_id'];

    public function cookie(){
        return $this->belongsTo(Cookie::class);
    }


    public static function isValid(): bool
    {
        $cookie = Cookie::where('name', static::$cookie_name)
            ->where('value', Cookie::local(static::$cookie_name))
            ->first();

        return ($cookie != null && $cookie->guest() instanceof Guest);
    }



    public static function current()
    {
        $cookie_value = Cookie::local(static::$cookie_name);
        $cookie = Cookie::where('name', static::$cookie_name)
            ->where('value', $cookie_value)
            ->first();

        if($cookie && $cookie->guest() instanceof Guest){
            return $cookie->guest();
        }

        return null;
    }


    public function todos(){
        return $this->hasMany(Todo::class);
    }
}
