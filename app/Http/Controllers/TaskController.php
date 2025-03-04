<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

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

        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,

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

            $task->update($request->all());
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



