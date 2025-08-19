<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignedFee extends Model
{
    //
     protected $fillable = [
        'student_id',
        'classroom_id',
        'section_id',
        'fee_type_id',
        'roll_no',
        'status',
        'paid_on'
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'classroom_id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    public function feeType()
    {
        return $this->belongsTo(FeeType::class, 'fee_type_id');
    }
}
