<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TaskController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tasks = Task::paginate(5);
        $projects = Project::all();
        $users = User::all();
        return view('tasks.tasks', compact("users", "projects", "tasks"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $Validated = $request->validate([
            'task_name' => "required|string|max:255",
            "project_id" => "required|exists:projects,id",
            "assigned_to" => "required|exists:users,id",
            "status" => "required|in:Pending,On Progress,Completed",
        ]);
        Task::create($Validated);
        if ($request->input("return_page") === "project-details") {
            return redirect()->route('projects.project-details', $Validated['project_id'])->with('success', 'Task added successfully');
        }

        return redirect('/tasks')->with('success', 'Task added successfully.');
    }
     
    public function update(Request $request){

        $task = Task::findOrFail($request->task_id);
         $Validated = $request->validate([
            'task_name' => "required|string|max:255",
            "project_id" => "required|exists:projects,id",
            "assigned_to" => "required|exists:users,id",
            "status" => "required|in:Pending,On Progress,Completed",
        ]);
        $task->update($Validated);
        if($request->input("return_page")==="project-details"){
           return redirect()->route('projects.project-details', $Validated['project_id'])->with('success', 'Task updated successfully');
        }
        return redirect('/tasks')->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function delete(Request $request)
    {
        $task = Task::findOrFail($request->task_id);
        $projectId = $task->project_id;
        $task->delete();
        if ($request->input('return_page') === 'project-details') {
            return redirect()->route('projects.project-details', ['id' => $projectId])->with('success', 'Task deleted successfully.');
        }
        return redirect('/tasks')
            ->with('success', 'Task deleted successfully.');
    }
}
