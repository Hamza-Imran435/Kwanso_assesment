<?php

namespace App\Http\Controllers;

use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct(protected TaskService $taskService) {}

    public function index()
    {
        return view('Task.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'task_name' => 'required',
            'description' => 'required',
        ]);

        $response = $this->taskService->store($request->all());

        return response()->json($response);
    }

    public function taskList(Request $request)
    {
        $response = $this->taskService->taskList($request->all());

        return $response;
    }

    public function update(Request $request)
    {
        $request->validate([
            'task_id' => 'required|exists:tasks,id',
            'task_name' => 'required',
            'description' => 'required',
        ]);

        $response = $this->taskService->update($request->all());

        return response()->json($response);
    }

    public function assignTask(Request $request)
    {
        $request->validate([
            'task_id' => 'required|exists:tasks,id',
            'customer_id' => 'required|exists:users,id',
        ]);

        $response = $this->taskService->assignTask($request->all());

        return $response;
    }
}
