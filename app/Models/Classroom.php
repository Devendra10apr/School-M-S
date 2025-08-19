<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    //
    protected $fillable =[
        'name'
    ];

    public function section(){
        return $this->hasMany(Section::class,'classroom_id');
    }
    public function timetables(){
        return $this->hasMany(Timetable::class,'classroom_id');
    }
}
