<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\ExamType;
use App\Models\Mark;
use App\Models\Section;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;

class MarkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $marks = Mark::with('student','subject','classroom','examType','section')->get();
        return view('admin.marks.index',compact('marks'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function getSections($classroomId)
    {
        $sections = Section::where('classroom_id', $classroomId)->get();
        return response()->json($sections);
    }

    // jab section auto fetch ho jaye tab same section me jitne student ho o bhi fetch ho jaye
    public function getStudents($classroomId, $sectionId)
    {
       $students = User::role('student')
            ->whereHas('studentProfile', function ($q) use ($classroomId, $sectionId) {
                $q->where('classroom_id', $classroomId)
                    ->where('section_id', $sectionId);
            })->get();
        return response()->json($students);
    }

    public function create()
    {
        $exam_types = ExamType::all();
        $classrooms = Classroom::all();
        $subjects = Subject::all();
        // $students = User::role('student')->get();
        return view('admin.marks.create', compact('exam_types', 'classrooms', 'subjects'));
    }


    /**
     * Store a newly created resource in storage.
     */
  public function store(Request $request)
{
    // ✅ Validate input
    $validated = $request->validate([
        'exam_type_id'     => 'required|exists:exam_types,id',
        'classroom_id'     => 'required|exists:classrooms,id',
        'section_id'       => 'required|exists:sections,id',
        'subject_id'       => 'required|exists:subjects,id',
        'student_id'       => 'required|exists:users,id',
        'total_marks'      => 'required|numeric',
        'obtained_marks'    => 'required|numeric',
        'practical_marks'  => 'required|numeric',
        'remarks'          => 'nullable|string',
    ]);

    // Prevent duplicate mark entries for same student + exam + subject
    $duplicate = Mark::where('exam_type_id', $request->exam_type_id)
        ->where('classroom_id', $request->classroom_id)
        ->where('section_id', $request->section_id)
        ->where('subject_id', $request->subject_id)
        ->where('student_id', $request->student_id)
        ->exists();

    if ($duplicate) {
        return back()
            ->withInput()
            ->withErrors(['duplicate' => '❌ This mark entry already exists for the selected student, exam, and subject.']);
    }

    
    $validated['status'] = 'active';

   
    Mark::create($validated);

    return redirect()->route('marks.index')->with('success', '✅ Marks entry created successfully!');
}

    /**
     * Display the specified resource.
     */
    public function show(Mark $mark)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mark $mark)
    {
        //
        
        $exam_types = ExamType::all();
        $classrooms = Classroom::all();
        $subjects = Subject::all();

        return view('admin.marks.edit',compact('mark','exam_types', 'classrooms', 'subjects'));
    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, Mark $mark)
{
    $validated = $request->validate([
        'exam_type_id'     => 'required|exists:exam_types,id',
        'classroom_id'     => 'required|exists:classrooms,id',
        'section_id'       => 'required|exists:sections,id',
        'subject_id'       => 'required|exists:subjects,id',
        'student_id'       => 'required|exists:users,id',
        'total_marks'      => 'required|numeric',
        'obtained_marks'   => 'required|numeric',
        'practical_marks'  => 'required|numeric',
        'remarks'          => 'nullable|string',
    ]);

    // ✅ Prevent duplicate mark entries, excluding the current one
    $duplicate = Mark::where('exam_type_id', $request->exam_type_id)
        ->where('classroom_id', $request->classroom_id)
        ->where('section_id', $request->section_id)
        ->where('subject_id', $request->subject_id)
        ->where('student_id', $request->student_id)
        ->where('id', '!=', $mark->id) // Exclude current mark
        ->exists();

    if ($duplicate) {
        return back()
            ->withInput()
            ->withErrors(['duplicate' => '❌ This mark entry already exists for the selected student, exam, and subject.']);
    }

    $validated['status'] = 'active';

    $mark->update($validated);

    return redirect()->route('marks.index')->with('success', '✅ Marks entry updated successfully!');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mark $mark)
    {
        //
        $mark->delete();
        return redirect()->route('marks.index')->with('success','marks entry deleted successfully!!!');
    }
}
