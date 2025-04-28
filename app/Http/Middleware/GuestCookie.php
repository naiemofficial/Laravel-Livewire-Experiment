<?php

namespace App\Http\Middleware;

use App\Http\Controllers\CookieController;
use App\Http\Requests\CookieRequest;
use App\Models\Guest;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Cookie;
use App\Models\Cookie as DBCookie;
use Illuminate\Support\Facades\Http;
use function PHPUnit\Framework\isEmpty;

class GuestCookie
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Generate new Guest if current Guest isn't registered or not valid
        if(!Guest::isValid()){
            // Prepare CookieRequest
            $new_cookie_value = Str::uuid()->toString();
            $request->merge([
                'name' => Guest::$cookie_name,
                'value' => $new_cookie_value
            ]);
            $CookieRequest = app(CookieRequest::class);
            $CookieRequest->merge($request->all());

            // New CookieController Instance
            $CookieController = new CookieController();
            return $CookieController->store($CookieRequest);
        }

        return $next($request);
    }
}
