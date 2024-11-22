<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'status'];

    public function tasks()
    {
        return $this->hasMany(Task::class, 'category_id', 'id');
    }

    public function HududTask()
    {
        return $this->hasMany(TaskRegion::class, 'category_id');
    }
}
