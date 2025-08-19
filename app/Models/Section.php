<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    //
    protected $fillable = [
        'name','classroom_id'
    ];

    public function classroom(){
        return $this->belongsTo(Classroom::class,'classroom_id');
    }
    public function timetables(){
        return $this->hasMany(Timetable::class,'section_id');
    }
}
