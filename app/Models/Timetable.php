<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    //
    protected $fillable = ['classroom_id','section_id','subject_id','teacher_id','day','start_time','end_time','status'];

    public function classroom(){
        return $this->belongsTo(Classroom::class,'classroom_id');
    }
    public function section(){
        return $this->belongsTo(Section::class,'section_id');
    }
    public function subject(){
        return $this->belongsTo(Subject::class,'subject_id');
    }
    public function teacher(){
        return $this->belongsTo(User::class,'teacher_id');
    }
}
