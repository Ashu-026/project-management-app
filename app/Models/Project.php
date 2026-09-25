<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'project_name',
        'manager_id',
        'summary',
        'start_date',
        'due_date',
        'status',
    ];

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }
    public function tasks()
    {
        return $this->hasMany(Task::class, 'project_id');
    }
}
