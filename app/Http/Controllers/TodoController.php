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
    public function update(Request $request, Todo $Todo)
    {
        try {
            $validated = $request->validate([
                'title'         => ['string', 'max:255'],
                'description'   => ['string'],
                'status'        => ['string'],
            ]);

            $updated_at = clone $Todo->updated_at;

            $Todo->update($validated);

            if($updated_at == $Todo->updated_at){
                return response()->json([
                    'info' => 'No changes made',
                    'change' => false
                ], 200);
            }

            return response()->json([
                'success' => 'Todo updated successfully',
                'data' => $Todo
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
        try {
            if($todo->trashed()){
                $todo->forceDelete();
                return response()->json([
                    'success' => 'Todo deleted successfully.',
                ], 200);
            } else {
                $todo->delete();
                return response()->json([
                    'pending' => 'Todo moved to trash',
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore(Todo $todo)
    {
        try {
            $todo->restore();
            return response()->json([
                'success' => 'Todo restored successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
