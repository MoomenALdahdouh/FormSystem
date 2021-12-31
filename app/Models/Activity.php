<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    public function worker()
    {
        return $this->hasOne(User::class, 'id', 'user_fk_id');
    }

    /*public function workers()
    {
        return $this->hasMany(Worker::class, 'id', 'worker_fk_id	');
    }*/

    public function subproject()
    {
        return $this->hasOne(Subproject::class, 'id', 'subproject_fk_id');
    }

    public function form(){
        return $this->hasOne(Form::class, 'activity_fk_id', 'id');
    }
}
