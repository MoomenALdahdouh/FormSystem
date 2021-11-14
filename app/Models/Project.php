<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    //use HasFactory;
    /* use SoftDeletes;
     protected $fillable = [
         'user_id',
         'name',
         'updated_at',
         'created_at',
         'deleted_at'
     ];*/

    use SoftDeletes;

    protected $table = "projects";
    protected $guarded = [];
    public $timestamps = false;

    //Here this function to join user table with category table by id and user_id and return one user by hasOne() function
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_fk_id');
    }
}
