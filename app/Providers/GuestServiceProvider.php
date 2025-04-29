<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Guest;


/**
 * @package App\Providers
 */
class GuestServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        View::composer('*', function ($view){
            if(!str_starts_with($view->getName(), 'livewire')){
                $view->with('isValidGuest', Guest::isValid());
            }
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
