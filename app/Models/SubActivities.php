<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubActivities extends Model
{
    protected $table = "subactivities";
    protected $guarded = [];
    public $timestamps = false;

    public function worker()
    {
        return $this->hasMany(Worker::class, 'id', 'user_fk_id');
    }

}
