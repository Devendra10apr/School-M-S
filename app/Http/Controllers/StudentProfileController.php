<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Section;
use App\Models\StudentParent;
use App\Models\StudentProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;


class StudentProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $studentProfile = StudentProfile::with('student', 'parent', 'classroom', 'section', 'parentdetails')->get();

        return view('admin.student-profile.index', compact('studentProfile'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        //$students = User::role('student')->get();
        //$parents = User::role('parent')->get();
        $classrooms = Classroom::all();
        $sections = Section::all();

        return view('admin.student-profile.create', compact('classrooms', 'sections'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            // Student
            'student_name' => 'required|string|max:256',
            'student_email' => 'required|email|unique:users,email',
            'student_mobile' => 'nullable|digits:10',
            'gender' => 'nullable|in:male,female,other',
            'dob' => 'required|date',
            'blood_group' => 'nullable|string|max:10',
            'religion' => 'nullable|string|max:50',
            'caste' => 'nullable|string|max:50',
            'aadhar_no' => 'required|digits:12',
            'tc_no' => 'nullable|max:50',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png',
            'address' => 'nullable|string',

            // Class & Section
            'classroom_id' => 'required|exists:classrooms,id',
            'section_id' => 'required|exists:sections,id',

            // Parent
            'father_name' => 'required|string|max:256',
            'mother_name' => 'required|string|max:256',
            'parent_email' => 'required|email|unique:users,email',
            'parent_mobile' => 'nullable|digits:10',
            'occupation' => 'nullable|string|max:256',
            'education' => 'nullable|string|max:256',
            'relation' => 'nullable|string|max:50',
            'parent_address' => 'nullable|string|max:256',
        ]);

        // Check parent alredy exists or not if no than create user
        $parentUser = User::where('email', $request->parent_email)->first();


        // Create Parent User
        if (!$parentUser) {
            $parentUser = User::create([
                'name' => $request->father_name,
                'email' => $request->parent_email,
                'password' => bcrypt('password'),
            ]);
            $parentUser->assignRole('parent');
        }

        $parentUser->studentParent()->create([
            'user_id' => $parentUser->id,
            'father_name' => $request->father_name,
            'mother_name' => $request->mother_name,
            'parent_email' => $request->parent_email,
            'parent_mobile' => $request->parent_mobile,
            'occupation' => $request->occupation,
            'education' => $request->education,
            'relation' => $request->relation,
            'address' => $request->parent_address,
        ]);

        $studentUser = User::where('email', $request->student_email)->first();
        if (!$studentUser) {
            // Create Student User
            $studentUser = User::create([
                'name' => $request->student_name,
                'email' => $request->student_email,
                'password' => bcrypt('password'),
            ]);
            $studentUser->assignRole('student');
        }

        // Upload Photo
        $photoName = null;
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $photoName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('student/profile'), $photoName);
        }

        // Auto Roll No
        $stu_count = StudentProfile::where('classroom_id', $request->classroom_id)
            ->where('section_id', $request->section_id)->count();
        $roll_no = $stu_count + 1;

        // Create Student Profile
        $studentUser->studentProfile()->create([
            'student_id' => $studentUser->id,  /// FK
            'classroom_id' => $request->classroom_id, // FK 
            'section_id' => $request->section_id,  //FK
            'parent_id' => $parentUser->id,  // FK
            'student_email' => $request->student_email,
            'student_mobile' => $request->student_mobile,
            'roll_no' => $roll_no,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'blood_group' => $request->blood_group,
            'religion' => $request->religion,
            'caste' => $request->caste,
            'aadhar_no' => $request->aadhar_no,
            'tc_no' => $request->tc_no,
            'address' => $request->address,
            'photo' => $photoName,
            'status' => 'active'
        ]);

        return redirect()->route('student-profiles.index')->with('success', 'Student admission created successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(StudentProfile $studentProfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StudentProfile $studentProfile)
    {
        //

        $students = User::role('student')->get();
        $parents = User::role('parent')->get();
        $classrooms = Classroom::all();
        $sections = Section::all();

        $studentparent = $studentProfile->parentdetails;
        return view('admin.student-profile.edit', compact('studentProfile', 'students', 'parents', 'classrooms', 'sections', 'studentparent'));
    }

    /**
     * Update the specified resource in storage.
     */





    public function update(Request $request, StudentProfile $studentProfile)
    {
        $studentUserId = $studentProfile->student_id;
        $parentUserId = $studentProfile->parent_id;

        $studentUser = User::findOrFail($studentUserId);
        $parentUser = User::findOrFail($parentUserId);

        // ✅ Step 1: Validate with dynamic email rules
        $request->validate([
            'student_name' => 'required|string|max:256',
            'student_email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($studentUser->id),
            ],
            'student_mobile' => 'nullable|digits:10',
            'gender' => 'nullable|in:male,female,other',
            'dob' => 'required|date',
            'blood_group' => 'nullable|string|max:10',
            'religion' => 'nullable|string|max:50',
            'caste' => 'nullable|string|max:50',
            'aadhar_no' => 'required|digits:12',
            'tc_no' => 'nullable|max:50',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png',
            'address' => 'nullable|string',

            'classroom_id' => 'required|exists:classrooms,id',
            'section_id' => 'required|exists:sections,id',

            'father_name' => 'required|string|max:256',
            'mother_name' => 'required|string|max:256',
            'parent_email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($parentUser->id),
            ],
            'parent_mobile' => 'nullable|digits:10',
            'occupation' => 'nullable|string|max:256',
            'education' => 'nullable|string|max:256',
            'relation' => 'nullable|string|max:50',
            'parent_address' => 'nullable|string|max:256',
        ]);

        // ✅ Step 2: Update Parent User
        $parentUser->update([
            'name' => $request->father_name,
            'email' => $request->parent_email, // dynamic validate already done
        ]);
        if (!$parentUser->hasRole('parent')) {
            $parentUser->assignRole('parent');
        }

        // ✅ Step 3: Update Student User
        $studentUser->update([
            'name' => $request->student_name,
            'email' => $request->student_email, // validated
        ]);
        if (!$studentUser->hasRole('student')) {
            $studentUser->assignRole('student');
        }

        // ✅ Step 4: Upload Photo
        $photoName = $studentProfile->photo ?? null;
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $photoName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('student/profile'), $photoName);
        }

        // ✅ Step 5: Roll No (if class/section changed)
        $roll_no = $studentProfile->roll_no;
        if (
            $studentProfile->classroom_id != $request->classroom_id ||
            $studentProfile->section_id != $request->section_id
        ) {
            $roll_no = StudentProfile::where('classroom_id', $request->classroom_id)
                ->where('section_id', $request->section_id)
                ->count() + 1;
        }

        // ✅ Step 6: StudentProfile Update
        $studentProfile->update([
            'student_id' => $studentUser->id,
            'classroom_id' => $request->classroom_id,
            'section_id' => $request->section_id,
            'parent_id' => $parentUser->id,
            'student_email' => $request->student_email,
            'student_mobile' => $request->student_mobile,
            'roll_no' => $roll_no,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'blood_group' => $request->blood_group,
            'religion' => $request->religion,
            'caste' => $request->caste,
            'aadhar_no' => $request->aadhar_no,
            'tc_no' => $request->tc_no,
            'address' => $request->address,
            'photo' => $photoName,
        ]);

        // ✅ Step 7: Parent Extra Info
        $parentUser->studentParent()->updateOrCreate(
            ['user_id' => $parentUser->id],
            [
                'father_name' => $request->father_name,
                'mother_name' => $request->mother_name,
                'parent_email' => $request->parent_email,
                'parent_mobile' => $request->parent_mobile,
                'occupation' => $request->occupation,
                'education' => $request->education,
                'relation' => $request->relation,
                'address' => $request->parent_address,
            ]
        );
        return redirect()->route('student-profiles.index')->with('success', '✅ Student Profile Updated Successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudentProfile $studentProfile)
    {
        //
        $$studentUser = $studentProfile->student;
        $parentUser = $studentProfile->parent;

        // Delete Parent 
        if ($parentUser) {
            $parentUser->studentParent()->delete();     
            $parentUser->syncRoles([]);                  
            $parentUser->delete();                       
        }

        // Delete Student 
        if ($studentUser) {
            $studentUser->syncRoles([]);                 
            $studentUser->delete();                      
        }

        // Delete the student profile 
        $studentProfile->delete();

        return redirect()->route('student-profiles.index')->with('success', 'Student Profile Deleted Successfully!!!');
    }
}
