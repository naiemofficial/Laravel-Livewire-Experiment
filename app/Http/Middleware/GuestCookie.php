<?php

namespace App\Http\Middleware;

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
        $cookie_name = 'guest_session';
        $cookie_value = Cookie::get($cookie_name);
        $db_cookie = DBCookie::where([
            ['name', '=', $cookie_name],
            ['value', '=', $cookie_value]
        ])->first();


        if(!$db_cookie){
            $new_cookie_value =  Str::uuid()->toString();
            $response = Http::withHeaders([
                'X-CSRF-TOKEN' => csrf_token(),
                'Accept' => 'application/json'
            ])->post(route('cookie.store'), [
                'name' => $cookie_name,
                'value' => $new_cookie_value,
                'guest' => $request->input('guest')
            ]);

            if(!$response->successful()){
                return response()->json([
                    'type' => 'error',
                    'error' => 'Failed to create cookie'
                ], 500);
            }
        }

        return $next($request);
    }
}
