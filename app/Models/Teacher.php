<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    //
    protected $fillable = ['user_id','mobile','dob','gender','aadhaar_no','education','subject','address','photo','status'];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
