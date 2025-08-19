<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    //

    protected $fillable = [
        'student_id','roll_number','classroom_id', 'section_id', 'exam_type_id', 'total_marks','obtained_marks', 'practical_marks', 'percentage', 'grade', 'status', 'remark', 'session',
        'published_at'

    ];

    public function student()
    {
        return $this->belongsTo(User::class,'student_id');
    }

    public function examType()
    {
        return $this->belongsTo(ExamType::class,'exam_type_id');
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class,'classroom_id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class,'section_id');
    }
}
