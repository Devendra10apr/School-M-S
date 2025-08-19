<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    //
    protected $fillable = [
        'exam_type_id','classroom_id','section_id','subject_id','exam_date','start_time','end_time','room_no','status'
    ];

    public function examType(){
        return $this->belongsTo(ExamType::class,'exam_type_id');
    }
    public function classroom(){
        return $this->belongsTo(Classroom::class,'classroom_id');
    }
    public function section(){
        return $this->belongsTo(Section::class,'section_id');
    }
    public function subject(){
        return $this->belongsTo(Subject::class,'subject_id');
    }
}
