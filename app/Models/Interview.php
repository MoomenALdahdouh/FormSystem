<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    //use HasFactory;
    protected $table = "interviews";
    protected $guarded = [];
    public $timestamps = false;

    public function answers()
    {
        return $this->hasMany(Answer::class, 'interview_fk_id', 'id');
    }

    public function form(){
        return $this->hasOne(Form::class, 'id', 'form_fk_id');
    }
}
