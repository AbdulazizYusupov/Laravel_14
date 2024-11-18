<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskRegion extends Model
{
    protected $fillable = [
        'task_id', 'hudud_id', 'status'
    ];

    public function task()
    {
        return $this->belongsTo(Task::class,'task_id');
    }
    public function hudud()
    {
        return $this->belongsTo(Hudud::class,'hudud_id');
    }
}