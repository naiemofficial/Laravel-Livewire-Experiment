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


    public static function isValid(string $cookie_value = null): bool
    {
        $cookie_value = $cookie_value ?? Cookie::local(self::$cookie_name);
        $cookie = Cookie::where('name', self::$cookie_name)
            ->where('value', $cookie_value)
            ->first();

        $Guest =  $cookie?->guest();
        return ($cookie != null && $Guest instanceof Guest);
    }



    public static function current(string $cookie_value = null)
    {
        $cookie_value = $cookie_value ?? Cookie::local(self::$cookie_name);
        $cookie = Cookie::where('name', self::$cookie_name)
            ->where('value', $cookie_value)
            ->first();

        $Guest = $cookie?->guest();
        if($Guest instanceof Guest){
            return $cookie->guest();
        }

        return null;
    }


    public function todos(){
        return $this->hasMany(Todo::class);
    }
}
