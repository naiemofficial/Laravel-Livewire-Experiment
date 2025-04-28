<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;
use App\Models\Cookie as DBCookie;
use Illuminate\Validation\Rule;

class GuestController extends Controller
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
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => ['string', 'required', 'max:255'],
                'cookie_id' => ['numeric', Rule::exists(DBCookie::class, 'id')],
            ]);

            $guest = Guest::create($validated);

            return response()->json([
                'key' => 'success',
                'message' => 'Successfully created guest!',
                'guest' => $guest
            ], 201);
        } catch (\Exception $e){
            return response()->json([
                'key' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Guest $guest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guest $guest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Guest $guest)
    {
        $validated = $request->validate([
            'name' => ['string', 'required', 'max:255'],
        ]);
        Guest::where('id', $guest->id)->update($validated);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guest $guest)
    {
        //
    }
}
