<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subproject extends Model
{
//    use HasFactory;
    use SoftDeletes;

    protected $table = "subprojects";
    protected $guarded = [];
    public $timestamps = false;

    //Here this function to join user table with category table by id and user_id and return one user by hasOne() function
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_fk_id');
    }

    public function mainProject()
    {
        return $this->hasOne(Project::class, 'id', 'project_fk_id');
    }

    public function activities()
    {
        return $this->hasMany(Activity::class, 'subproject_fk_id', 'id');
    }
}
