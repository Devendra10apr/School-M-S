<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeeType extends Model
{
    //
    protected $fillable = [
        'fee_type_id','name','amount','due_date','late_fee','status',
    ];

    public function feeCategory(){
        return $this->belongsTo(FeeCategory::class,'fee_type_id');
    }
}
