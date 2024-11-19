<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['name', 'title', 'file', 'data', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function HududTask()
    {
        return $this->hasMany(TaskRegion::class, 'task_id','id');
    }
    public function javob()
    {
        return $this->hasMany(Javob::class, 'task_id','id');
    }
}
