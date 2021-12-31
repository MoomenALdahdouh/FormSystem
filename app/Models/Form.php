<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    //use HasFactory;
    protected $table = "form";
    protected $guarded = [];
    public $timestamps = false;


    public function activity()
    {
        return $this->hasOne(Activity::class, 'id', 'activity_fk_id');
    }

    public function interviews()
    {
        return $this->hasMany(Interview::class, 'form_fk_id', 'id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'form_fk_id', 'id');
    }

    public function workers()
    {
        return $this->hasMany(Worker::class, 'form_fk_id', 'id');
    }

}
