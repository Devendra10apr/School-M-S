<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Mockery\Matcher\Subset;

class AssignedSubject extends Model
{
    //
    protected $fillable = ['classroom_id','section_id','subject_id','teacher_id'];

    public function class(){
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
