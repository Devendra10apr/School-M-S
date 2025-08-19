<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentParent extends Model
{
    //
    protected $fillable = [
        'user_id','father_name','mother_name','parent_email','parent_mobile','occupation','education','relation','address'
    ];

     public function user() {
        return $this->belongsTo(User::class,'user_id');
    }

    public function students() {
        return $this->hasMany(StudentProfile::class, 'parent_id');
    }
}
