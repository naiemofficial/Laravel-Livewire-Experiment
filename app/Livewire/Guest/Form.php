<?php

namespace App\Livewire\Guest;

use App\Http\Middleware\GuestCookie;
use App\Models\Cookie as DBCookie;
use Illuminate\Support\Facades\Cookie;
use Livewire\Component;

class Form extends Component
{
    public $name;
    public function store(){
        $guest_name = $this->name;
        request()->merge(['guest' => $guest_name]);
        $GuestCookie = new GuestCookie(request());

    }
    public function render()
    {
        $cookie_name = 'guest_session';
        $cookie_value = Cookie::get($cookie_name);
        $db_cookie = DBCookie::where([
            ['name', '=', $cookie_name],
            ['value', '=', $cookie_value]
        ])->first();

        if(!empty($db_cookie)){
            $this->name = $db_cookie?->guest()?->name ?? '';
        }


        return view('livewire.guest.form');
    }
}
