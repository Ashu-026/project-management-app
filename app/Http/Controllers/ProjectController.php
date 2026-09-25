<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\User;
use Symfony\Component\HttpFoundation\RateLimiter\RequestRateLimiterInterface;

class ProjectController extends Controller
{

    /**
     * Display a listing of the resource.
     */

    public function create(Request $request)
    {
        $projects = Project::paginate(5);
        $users = User::all();
        return view('projects.projects', compact("users", "projects"));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $validated = $request->validate([
            "project_name" => "required|string|max:255",
            "manager_id" => "required|exists:users,id",
            "summary" => "required|string|max:255",
            "start_date" => "required|date",
            "due_date" => "required|date|after_or_equal:start_date",
            "status" => "required|in:Pending,On Progress,Completed",
        ]);
        Project::create($validated);
        return redirect('/projects')->with('success', 'Project added successfully.');
    }
    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request,)
    {
        $project = Project::findOrFail($request->project_id);
        $validated = $request->validate([
            "project_name" => "required|string|max:255",
            "manager_id" => "required|exists:users,id",
            "summary" => "required|string|max:255",
            "start_date" => "required|date",
            "due_date" => "required|date|after_or_equal:start_date",
            "status" => "required|in:Pending,On Progress,Completed",
        ]);
        $project->update($validated);
        if ($request->return_page == 'project-details') {
            return redirect()->route('projects.project-details', $project->id)->with('success', 'Project edited successfully.');
        } else {
            return redirect('/projects')->with('success', 'Project edited successfully.');
        }
    }
    /**
     * Remove the specified resource from storage.
     */

    public function delete(Request $request)
    {
        $project = Project::findOrFail($request->project_id);
        $project->delete();
        return redirect('/projects')->with('success', 'Project deleted successfully.');
    }
    // To show id in project-details page 
    public function view($id)
    {
        $project = Project::findOrFail($id);
        $tasks = $project->tasks()->paginate(3);
        $users = User::all();
        return view('projects.project-details', compact("users", "project","tasks"));
    }
}
