<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Models\Dashboard;

// Login 
Route::get('/', [AuthController::class, 'login']);
Route::get('/login', [AuthController::class, 'login']);
Route::post('/login',[AuthController::class, 'authenticate']);
// logout routes 
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// Register routes
Route::get('/register',[AuthController::class, 'login']);
Route::post('/register',[AuthController::class, 'register']);

// Profile routes
Route::get('/profile',[AuthController::class, 'profile']);
Route::put('/profile/update',[AuthController::class, 'updateProfile'])->name('profile.update');

// Dashboard routes 
Route::get("/dashboard",[DashboardController::class,'index']);

// project routes
Route::get("/projects",[ProjectController::class,'create']);
Route::post("/projects",[ProjectController::class,'store'])->name('projects.store');
Route::put("/projects/update",[ProjectController::class,'update'])->name('projects.update');
Route::delete("/projects/delete",[ProjectController::class,'delete'])->name('projects.delete');

// project_details routes
Route::get('/projects/{id}/project-details', [ProjectController::class, 'view'])
    ->name('projects.project-details');

// tasks routes
Route::get("/tasks",[TaskController::class,'create']);
Route::post("/tasks",[TaskController::class,'store'])->name('tasks.store');
Route::put("/tasks/update",[TaskController::class,'update'])->name('tasks.update');
Route::delete("/tasks/delete",[TaskController::class,'delete'])->name('tasks.delete');

// User routes 
Route::get('/users',[UserController::class,'showUser']);
Route::delete('/users/delete', [UserController::class, 'deleteUser'])->name('users.deleteUser');
Route::put('/users/edit', [UserController::class, 'editUser'])->name('users.editUser');



