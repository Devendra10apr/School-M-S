<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentAttendance extends Model
{
    //
    protected $fillable = ['student_id','classroom_id','section_id','attendance_date','status','roll_no'];


    public function student(){
        return $this->belongsTo(User::class,'student_id');
    }

    public function classroom(){
        return $this->belongsTo(Classroom::class,'classroom_id');
    }

    public function section(){
        return $this->belongsTo(Section::class,'section_id');
    }
}
