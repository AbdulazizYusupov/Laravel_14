<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Javob extends Model
{
    protected $fillable = ['hudud_id','task_id','title','file','izoh','status'];

    public function hudud()
    {
        return $this->belongsTo(Hudud::class,'hudud_id');
    }
    public function task()
    {
        return $this->belongsTo(Task::class,'task_id');
    }
}
