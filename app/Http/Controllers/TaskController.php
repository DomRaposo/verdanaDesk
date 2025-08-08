<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['data' => Task::all()]);
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
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $task = Task::create($validated);
        return response()->json(['message' => 'Created', 'task' => $task], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return response()->json($task);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $task->update($validated);
        return response()->json(['message' => 'Updated', 'task' => $task]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(['message' => 'Deleted']);
    }

    public function stats()
    {
        return response()->json([
            'total' => Task::count(),
        ]);
    }

    public function close(Task $task)
    {
        return response()->json(['message' => 'Closed', 'task' => $task]);
    }

    public function getResponses(Task $task)
    {
        return response()->json(['responses' => []]);
    }

    public function storeResponse(Request $request)
    {
        return response()->json(['message' => 'Response stored']);
    }

    public function gerarPDF()
    {
        return response()->json(['message' => 'Report generation not implemented']);
    }

    public function filter(string $status)
    {
        return response()->json(['status' => $status, 'data' => []]);
    }
}
