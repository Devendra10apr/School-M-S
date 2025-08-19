<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Exam;
use App\Models\ExamType;
use App\Models\Section;
use App\Models\Subject;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $exams = Exam::with('examType','classroom','section','subject')->get();
        return view('admin.exams.index',compact('exams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $exam_types = ExamType::all();
        $classrooms = Classroom::all();
        $subjects = Subject::all();
        return view('admin.exams.create', compact('exam_types', 'classrooms', 'subjects'));
    }

    public function getSections($classroomId)
    {
        $sections = Section::where('classroom_id', $classroomId)->get();
        return response()->json($sections);
        
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
       $valideted = $request->validate([
            'exam_type_id' => 'required|exists:exam_types,id',
            'classroom_id' => 'required|exists:classrooms,id',
            'section_id' => 'required|exists:sections,id',
            'subject_id' => 'required|exists:subjects,id',
            'exam_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'room_no' => 'nullable|string|max:100',
            'status' => 'required|in:active,inactive',
        ]);
        Exam::create($valideted);

        return redirect()->route('exams.index')->with('success','Exam Created Successfully!!!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Exam $exam)
    {
        //
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exam $exam)
    {
        //
         $exam_types = ExamType::all();
        $classrooms = Classroom::all();
        $subjects = Subject::all();
        return view('admin.exams.edit',compact('exam_types','classrooms','subjects','exam'));
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, Exam $exam)
{
    $validated = $request->validate([
        'exam_type_id' => 'required|exists:exam_types,id',
        'classroom_id' => 'required|exists:classrooms,id',
        'section_id' => 'required|exists:sections,id',
        'subject_id' => 'required|exists:subjects,id',
        'exam_date' => 'required|date',
        'start_time' => 'required|date_format:H:i',
        'end_time' => 'required|date_format:H:i|after:start_time',
        'room_no' => 'nullable|string|max:100',
        'status' => 'required|in:active,inactive',
    ]);
//dd($request->all());
    $exam->update($validated);

    return redirect()->route('exams.index')->with('success', 'Exam Updated Successfully!!!');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exam $exam)
    {
        //
        $exam->delete();

        return redirect()->route('exams.index')->with('success','Exam Deleted Successfully!!!');
    }
}
