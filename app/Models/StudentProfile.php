<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentProfile extends Model
{
    //
    protected $fillable =[
        'student_id','classroom_id','section_id','parent_id','roll_no','student_email','student_mobile','gender', 'dob', 'blood_group', 'religion','caste', 'aadhar_no', 'tc_no', 'address', 'photo','status'
    ];

    public function student(){
        return $this->belongsTo(User::class,'student_id');
    }

    public function classroom(){
        return $this->belongsTo(Classroom::class,'classroom_id');
    }

    public function section(){
        return $this->belongsTo(Section::class,'section_id');
    }
    public function parent(){
        return $this->belongsTo(User::class,'parent_id');
    }
    // public function parentDetail() {
    // return $this->belongsTo(StudentParent::class, 'parent_id', 'user_id');
    // }
  public function parentdetails()
{
    return $this->hasOne(StudentParent::class, 'user_id', 'parent_id');
}


}
