<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::all();
        return response()->json($tasks, 200);
    }


    public function store(request $request)
    {
        $request->validate([
            "title" => "string|required",
            "description" => "string|required",
        ]);

             $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id'=> Auth::id(),

        ]);
        return response()->json([
            "status" => "success",
            "message" => "
            Task created successfully.
            ",
            "data" => $task
        ], 201);

    }


    public function update(Request $request, Task $task)
    {
        //  Task::findOrFail($task);

                $fields=$request->validate([
                    "title" => "string|required",
                    "description" => "string|required",
                    "status" => "string|in:pending,in_progress,completed",
                ]);
            $task->update($fields);
            return response()->json([
                "status" => "success",
                "message" => "Task updated successfully.",
                "data" => $task
            ], 200);

    }
    public function destroy(task $task)
    {


            $task->delete();
            return response()->json([
                "status" => "success",
                "message" => "Task deleted successfully."
            ], 200);
        }
    }



