<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hudud extends Model
{
    protected $fillable = ['name','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class );
    }
    public function HududTask()
    {
        return $this->hasMany(TaskRegion::class,'hudud_id','id');
    }
    public function javob()
    {
        return $this->hasMany(Javob::class,'hudud_id','id');
    }
}
