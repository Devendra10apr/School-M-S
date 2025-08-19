<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    //
    protected $fillable = [
      'exam_type_id','classroom_id','section_id','subject_id','student_id','total_marks','obtained_marks','practical_marks','remarks','status'  
    ];

   
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'classroom_id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    public function examType()
    {
        return $this->belongsTo(ExamType::class, 'exam_type_id');
    }
}
