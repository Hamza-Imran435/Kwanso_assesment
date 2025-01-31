<?php

namespace App\Services;

use App\Models\Task;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;

class TaskService
{

    public function store($request)
    {
        $task = Task::updateOrCreate([
            'task_name' => $request['task_name'],
        ], [
            'description' => $request['description'],
        ]);

        return [
            'success' => true,
            'message' => 'Task created successfully'
        ];
    }

    public function taskList($request)
    {
        $user = auth()->user();

        $tasks = Task::query()
            ->when($user->roles[0]['name'] === 'Client', function ($query) use ($user) {
                // $query->with('users')->where('user_id', $user->id);
                $query->whereHas('users', function ($q) use ($user) {
                    $q->where('user_id', $user->id);
                });
            })
            ->orderBy('created_at', 'desc');

        return DataTables::of($tasks)
            ->addColumn('DT_RowIndex', function ($row) {
                static $index = 0;
                $index++;
                return $index;
            })
            ->addColumn('action', function ($row) use ($user) {
                $buttons = '';
                if ($user->hasPermission('manage-task')) {
                    $buttons .= '<button class="btn btn-sm btn-warning edit-task"
                                data-id="' . $row->id . '"
                                data-task=\'' . json_encode($row) . '\'>
                            Edit
                        </button>
                        <button class="btn btn-sm btn-danger delete-btn"
                                data-id="' . $row->id . '">
                            Delete
                        </button>';
                } else {
                    $buttons .= '<button class="btn btn-sm btn-info" disabled>Access Denied</button>';
                }

                return $buttons;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function update($request)
    {
        $task = Task::find($request['task_id']);

        if (!$task) {
            return [
                'success' => false,
                'message' => 'Task not found'
            ];
        }

        $task->update([
            'task_name' => $request['task_name'],
            'description' => $request['description'],
        ]);

        return [
            'success' => true,
            'message' => 'Task updated successfully'
        ];
    }

    public function assignTask($request)
    {
        $user = User::findOrFail($request['customer_id']);
        $task = Task::findOrFail($request['task_id']);

        if (!$user->tasks->contains($task)) {
            $user->tasks()->attach($task);
            return response()->json(['success' => true, 'message' => 'Task assigned successfully.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Task is already assigned to the user.']);
        }
    }
}
