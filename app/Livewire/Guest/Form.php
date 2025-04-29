<?php

namespace App\Livewire\Guest;

use App\Http\Controllers\GuestController;
use App\Http\Middleware\GuestCookie;
use App\Models\Cookie;
use App\Models\Guest;
use Livewire\Component;
use Illuminate\Support\Facades\Cookie as CookieFacade;

class Form extends Component
{
    public $name;
    public $isValidGuest = false;
    public $currentGuest;
    public $cookie;

    public function store(){
        request()->merge(['name' => $this->name]);
        if(Guest::isValid()){
            // Update
            app(GuestController::class)->update(request(), Guest::current());
        } else {
            // Add as new

            $GuestCookie = new GuestCookie();
            $response = $GuestCookie->handle(request(), fn($request) => $request);

            // Re-check Guest validation
            $response_data = $response->getData();
            $this->cookie = $response_data->cookie ?? null;
            $this->isValidGuest = Guest::isValid($this->cookie);
            $this->currentGuest = Guest::current($this->cookie);
        }
    }


    public function render()
    {
        $this->currentGuest = Guest::current($this->cookie);
        $this->isValidGuest = Guest::isValid($this->cookie);

        if($this->currentGuest instanceof Guest){
            $this->name = $this->currentGuest->name;
        }
        return view('livewire.guest.form');
    }
}
