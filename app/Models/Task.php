<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    protected $fillable = [
        'task_name',
        'project_id',
        'assigned_to',
        'due_date',
        'status',
    ];

    public function manager()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
