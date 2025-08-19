<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    //
    protected $fillable = [
        'name','code'
    ];

    public function timetables(){
        return $this->hasMany(Timetable::class,'subject_id');
    }
}
