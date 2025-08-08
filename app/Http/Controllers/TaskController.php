<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TaskService;

class TaskController extends Controller
{
    protected TaskService $service;

    public function __construct(TaskService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return response()->json($this->service->index());
    }

    public function store(Request $request)
    {
        return response()->json($this->service->store($request->all()), 201);
    }

    public function show($id)
    {
        return response()->json($this->service->show($id));
    }

    public function update(Request $request, $id)
    {
        return response()->json($this->service->update($id, $request->all()));
    }

    public function destroy($id)
    {
        return response()->json($this->service->destroy($id));
    }

    public function filterByStatus($status)
    {
        return response()->json($this->service->filterByStatus($status));
    }

    public function close($id)
    {
        return response()->json($this->service->closeChamado($id));
    }
}
