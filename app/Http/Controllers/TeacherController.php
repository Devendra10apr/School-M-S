<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use function Ramsey\Uuid\v1;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $teachers = Teacher::with('user')->get();
        return view('teacher.teacher-profile.index',compact('teachers'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('teacher.teacher-profile.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
         $teacheruser = User::where('email',$request->email)->first();
         $userIdToIgnore = $teacheruser ? $teacheruser->id : null; 

        $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => ['required','email',Rule::unique('users','email')->ignore($userIdToIgnore)], 
            'mobile'      => 'required|digits:10',
            'dob'         => 'nullable|date',
            'gender'      => 'required|in:male,female,other',
            'aadhaar_no'  => 'nullable|digits:12',
            'education'   => 'nullable|string|max:256',
            'subject'     => 'nullable|string|max:256',
            'address'     => 'nullable|string|max:256',
            'photo'       => 'nullable|image|mimes:png,jpg,jpeg,gif|max:2048',
        ]);

       
        if(!$teacheruser){
            $teacheruser = User::create([
                'name' => $request->name,
                'email'=>$request->email,
                'password'=>bcrypt('password'),
            ]);
            $teacheruser->assignRole('teacher');
        }
        // check teacher user_id pahle se hai ki nhi
        if(Teacher::where('user_id',$teacheruser->id)->exists()){
            return back()->with('error','Teacher user is already a teacher!!');
        }
        // photo upload 
        $photoname = null;
        if($request->hasFile('photo')){
            $file = $request->file('photo');
            $photoname = time() .'.'.$file->getClientOriginalExtension();
            $file->move(public_path('teacher/profile'),$photoname);
        }

        Teacher::create([
            'user_id'=>$teacheruser->id,
            'mobile'=>$request->mobile,
            'dob'=>$request->dob,
            'gender'=>$request->gender,
            'aadhaar_no'=>$request->aadhaar_no,
            'education'=>$request->education,
            'subject'=>$request->subject,
            'address'=>$request->address,
            'photo'=>$photoname,
            'status'=>'active',
        ]);

        return redirect()->route('teachers.index')->with('success',' 👨‍🏫 Teacher Register Successfully!!!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        //
        // also eager load like $teacher->load('user)
       $teachers = Teacher::with('user')->first();
       return view('teacher.teacher-profile.edit',compact('teachers'));
        

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher)
    {
        //
        $teacheruser = User::find($teacher->user_id);
        

        $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => ['required','email',Rule::unique('users','email')->ignore($teacheruser->id)], 
            'mobile'      => 'required|digits:10',
            'dob'         => 'nullable|date',
            'gender'      => 'required|in:male,female,other',
            'aadhaar_no'  => 'nullable|digits:12',
            'education'   => 'nullable|string|max:256',
            'subject'     => 'nullable|string|max:256',
            'address'     => 'nullable|string|max:256',
            'photo'       => 'nullable|image|mimes:png,jpg,jpeg,gif|max:2048',
        ]);

       
        
            $teacheruser->update([
                'name' => $request->name,
                'email'=>$request->email,
                
            ]);
        
        // photo upload 
        $photoname = null;
        if($request->hasFile('photo')){
            $file = $request->file('photo');
            $photoname = time() .'.'.$file->getClientOriginalExtension();
            $file->move(public_path('teacher/profile'),$photoname);
        }

      $teacher->update([
            'user_id'=>$teacheruser->id,
            'mobile'=>$request->mobile,
            'dob'=>$request->dob,
            'gender'=>$request->gender,
            'aadhaar_no'=>$request->aadhaar_no,
            'education'=>$request->education,
            'subject'=>$request->subject,
            'address'=>$request->address,
            'photo'=>$photoname,
            'status'=>'active',
        ]);

        return redirect()->route('teachers.index')->with('success',' 👨‍🏫 Teacher Updates Successfully!!!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        //
        $teacheruser = $teacher->user;

        if($teacher->photo && file_exists(public_path('teacher/profile/' . $teacher->photo))){
            unlink(public_path('teacher/profile/'. $teacher->photo));
        }

        if($teacheruser){
            $teacheruser->syncRoles([]);
            $teacheruser->delete();  // yaha humne teacher user delete 

        }

        // yaha teacher profile
        $teacher->delete();

        return redirect()->route('teachers.index')->with('success','Teahers user and profile deleted Successfully!!!');
    }
}
