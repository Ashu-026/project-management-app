<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\User;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request){
        $currentUser = Auth::user()->name;
        $totalUsers = User::count();
        $totalProjects = Project::count();
        $totalTasks = Task::count();
        $pendingTasks= Task::where('status', 'Pending')->count();
        $onGoingTasks= Task::where('status', 'On Progress')->count();
        $completedTasks= Task::where('status', 'Completed')->count();
        $recentProjects = Project::latest()->take(3)->get();
        $recentUsers = User::latest()->take(3)->get();
        return view('dashboards.dashboards', compact('totalProjects','totalTasks','totalUsers','pendingTasks','onGoingTasks','completedTasks','recentProjects','recentUsers','currentUser'));
    }
    
}
