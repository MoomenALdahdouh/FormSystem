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
}