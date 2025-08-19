<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AssignedSubject;
use App\Models\Classroom;
use App\Models\Section;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;

class AssignedSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $assign= AssignedSubject::with('class','subject','section','teacher')->get();
        return view('admin.assign-subject.index',compact('assign'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $classes = Classroom::all();
        $sections = Section::all();
        $subjects = Subject::all();
        $teachers = User::role('teacher')->get();
        
        return view('admin.assign-subject.create',compact('classes','sections','subjects','teachers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
       $vali = $request->validate([
            'classroom_id'=>'required|exists:classrooms,id',
            'section_id'=>'required|exists:sections,id',
            'subject_id'=>'required|exists:subjects,id',
            'teacher_id'=>'required|exists:users,id',
        ]);

        AssignedSubject::create($vali);

        return redirect()->route('assignedSubject.index')->with('success','Subject Assign to Teacher Successfully!!');
    }

    /**
     * Display the specified resource.
     */
    public function show(AssignedSubject $assignedSubject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AssignedSubject $assignedSubject)
    {
        
        $classes = Classroom::all();
        $sections = Section::all();
        $subjects = Subject::all();
        $teachers = User::role('teacher')->get();
        
        return view('admin.assign-subject.edit',compact('assignedSubject','classes','sections','subjects','teachers'));
      
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AssignedSubject $assignedSubject)
    {
        //
        $valid= $request->validate([
            'classroom_id'=>'required|exists:classrooms,id',
            'section_id'=>'required|exists:sections,id',
            'subject_id'=>'required|exists:subjects,id',
            'teacher_id'=>'required|exists:users,id',
        ]);

       $exists = AssignedSubject::where([
        'classroom_id' => $request->classroom_id,
        'section_id' => $request->section_id,
        'subject_id' => $request->subject_id,
       ])->where('id', '!=', $assignedSubject->id)->exists();
       if($exists){
            return back()->with('error', 'This subject is already assigned to this class & section.');
       }

       $assignedSubject->update($valid);

        return redirect()->route('assignedSubject.index')->with('success','Subject Assign to Teacher Successfully!!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AssignedSubject $assignedSubject)
    {
        $assignedSubject->delete();
        return redirect()->route('assignedSubject.index')->with('success','Assigned Subject Deleted Successfully!!');
    }
}
