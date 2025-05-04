<?php

namespace App\Http\Controllers;

use App\Http\Middleware\GuestAuth;
use App\Http\Requests\TodoRequest;
use App\Models\Guest;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class TodoController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('todo.index');
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
                'title' => ['required', 'string', 'max:255'],
                'description' => ['required', 'string'],
                'guest_id' => ['required', 'integer'],
            ]);

            $Todo = Todo::create($validated);
            return response()->json([
                'success' => 'Todo created successfully.',
                'id' => $Todo->id
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $todo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo)
    {
        try {
            $validated = $request->validate([
                'title'         => ['string', 'max:255'],
                'description'   => ['string'],
                'status'        => ['string'],
            ]);

            $todo->update($validated);

            return response()->json([
                'success' => 'Todo updated successfully',
                'data' => $todo
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        //
    }
}
