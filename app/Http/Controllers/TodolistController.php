<?php

namespace App\Http\Controllers;

use App\Http\Resources\TodolistResource;
use App\Models\Todolist;
use Exception;
use Illuminate\Http\Request;

class TodolistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todolist = Todolist::latest()->get();
        
        return TodolistResource::collection($todolist);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'tittle' => 'required|min:3|max:255',
            'desc' => 'required|min:3|max:255',
            'its_done' => 'required|in:0,1'
        ]);
        try {
            $todolist = Todolist::create($data);
            
            return response()->json([
                'message'=> 'todolist created successfully',
                'data' => new TodolistResource($todolist)
            ], 201);
        } catch (Exception $error) {
            return response()->json(['message'=>'todolist created failed'], 500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $todolist = Todolist::find($id);
        
        if ($todolist==null) {
            return response()->json(['message' => 'todolist not found'], 404);
        }
        
        return new TodolistResource($todolist);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'tittle' => 'required|min:3|max:255',
            'desc' => 'required|min:3|max:255',
            'its_done' => 'required|in:0,1'
        ]);

        $todolist = Todolist::find($id);
        
        if ($todolist==null) {
            return response()->json(['message' => 'todolist not found'], 404);
        }

        try {
            $todolist->update($data);

            return response()->json([
                'message' => 'todolist updated successfully',
                'data' => new TodolistResource($todolist)
            ], 200);
        } catch (Exception $error) {
            return response()->json(['message'=>'todolist updated failed'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $todolist = Todolist::find($id);
        
        if ($todolist==null) {
            return response()->json(['message' => 'todolist not found'], 404);
        }

        try {
            $todolist->delete();

            return response()->json([
                'message' => 'todolist deleted successfully',
            ], 200);
        } catch (Exception $error) {
            return response()->json(['message'=>'todolist deleted failed'], 500);
        }
    }
}
