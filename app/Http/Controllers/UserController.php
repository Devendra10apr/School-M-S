<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function dashboard(){
        $user = Auth::user();
        if($user->hasRole('admin')){
        return view('admin.index');
        }elseif($user->hasrole('teacher')){
        return view('teacher.index');
        }
        else{
            abort(403, 'Unauthorized access');
        }
        
    }
}
