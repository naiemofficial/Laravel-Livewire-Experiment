<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;
use App\Http\Requests\CookieRequest;
use App\Models\Cookie as DBCookie;
use Illuminate\Support\Facades\Cookie;
use Carbon\Carbon;
use function Laravel\Prompts\error;
use function PHPUnit\Framework\isEmpty;
use App\Http\Controllers\GuestController;
use Illuminate\Support\Facades\Log;

class CookieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    private function calculateCookieLifespan($date){
        if(isEmpty($date)){
            $lifespan = 0;
        } else if(Carbon::parse($date)->isValid()){
            $lifespan = now()->diffInMinutes(Carbon::parse($date), false);
            if($lifespan <= 0){
                $lifespan = 0;
            }
        } else {
            $lifespan = 60;
        }
        return $lifespan;
    }
    public function store(CookieRequest $request)
    {
        $validated = $request->validated();
        try {
            $cookie = DBCookie::create($validated);

            // If there is a 'guest' name
            if($request->has('guest')){
                $GuestRequest = $request->all();
                $GuestRequest['cookie_id'] = $cookie->id;

                // Attributes refactor
                $GuestRequest['name'] = $request['guest'];
                unset($GuestRequest['guest'], $GuestRequest['value']);



                $GuestController = new GuestController();
                $response = $GuestController->store(new Request($GuestRequest));

                if($response->isSuccessful()){
                    // Create Cookie in the Browser
                    Cookie::queue($validated['name'], $validated['value'], $this->calculateCookieLifespan($validated['expires_at'] ?? 0));
                    return response()->json([
                        'type' => 'success',
                        'cookie' => $cookie ? true : false,
                        'message' => 'Successfully created guest!',
                    ], 201);
                } else {
                    $cookie->delete(); // Delete the created cookie since Guest creation is failed!
                    return $response;
                }
            }

            // Create Cookie in the Browser
            Cookie::queue($validated['name'], $validated['value'], $this->calculateCookieLifespan($validated['expires_at'] ?? 0));
            return response()->json([
                'message' => 'Cookie added successfully',
                'cookie' => $cookie
            ], 201);

        } catch (\Exception $e){
            Log:error("Cookie Creation: " . $e->getMessage());
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $name)
    {
        $cookie_name = $name;
        $cookie_value = 'test'; // Cookie::get($cookie_name);
        $db_cookie = DBCookie::where([
            ['name', '=', $cookie_name],
            ['value', '=', $cookie_value]
        ])->first();

        dd($db_cookie->guest()->name);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
