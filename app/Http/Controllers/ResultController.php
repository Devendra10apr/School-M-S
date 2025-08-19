<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\ExamType;
use App\Models\Mark;
use App\Models\Result;
use App\Models\Section;
use App\Models\StudentParent;
use Illuminate\Http\Request;
use App\Models\StudentProfile;

class ResultController extends Controller
{


    public function generate()
    {
        $examTypes = ExamType::where('status', 'active')->get();
        $classrooms = Classroom::all();

        return view('admin.results.generate', compact('examTypes', 'classrooms'));
    }

    public function fetchStudents(Request $request)
    {
        // $request->validate([
        //     'exam_type_id' => 'required|exists:exam_types,id',
        //     'classroom_id' => 'required|exists:classrooms,id',
        //     'section_id' => 'required|exists:sections,id',
        // ]); agar chahiye to hum use kar sakte 

        $examTypes = ExamType::where('status', 'active')->get();
        $classrooms = Classroom::all();

        $students = StudentProfile::with('student')
            ->where('classroom_id', $request->classroom_id)
            ->where('section_id', $request->section_id)
            ->get();

        $examname = ExamType::find($request->exam_type_id);
        return view('admin.results.generate', [
            'examTypes' => $examTypes,
            'classrooms' => $classrooms,
            'students' => $students,
            'selected_exam_type_id' => $request->exam_type_id,
            'selected_classroom_id' => $request->classroom_id,
            'selected_section_id' => $request->section_id,
            'selected_exam_type_name'=>$examname->name,
        ]);
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
            $student_id = $request->student_id;
            $exam_type_id = $request->exam_type_id;
            $classroom_id = $request->classroom_id;
            $section_id = $request->section_id;

            // mai class name aur section name show karna chahta hu
            $classroom = Classroom::find($classroom_id);
            $section = Section::find($section_id);

            $student = StudentProfile::where('student_id',$student_id)->with('student')->first();

            $marks = Mark::with('subject')->where('student_id',$student_id)->where('exam_type_id',$exam_type_id)->where('classroom_id',$classroom_id)->where('section_id',$section_id)->get();

            $total = $marks->sum('total_marks');
            $obtained_marks = $marks->sum('obtained_marks');
            $practical_marks = $marks->sum('practical_marks');
            $total_obtained = $obtained_marks + $practical_marks;

            $percentage = $total > 0 ? ( $total_obtained/$total)*100 : 0;

            $grade = $percentage >= 90 ? 'A+' : ($percentage >= 80 ? 'A' : ($percentage >= 70 ? 'B' : ($percentage >= 60 ? 'C' : 'F')));

            $status =   $status = $percentage >= 33 ? 'Pass' : 'Fail';

            return view('admin.results.create',compact('student','marks','exam_type_id','classroom_id','section_id','total','obtained_marks','practical_marks','total_obtained','percentage','grade','status','classroom','section'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
          $request->validate([
        'student_id' => 'required',
        'exam_type_id' => 'required',
        'classroom_id' => 'required',
        'section_id' => 'required',
    ]);

    Result::create([
        'student_id' => $request->student_id,
        'roll_number' => $request->roll_number,
        'exam_type_id' => $request->exam_type_id,
        'classroom_id' => $request->classroom_id,
        'section_id' => $request->section_id,
        'total_marks' => $request->total_marks,
        'obtained_marks' => $request->obtained_marks,
        'practical_marks' => $request->practical_marks,
        'percentage' => $request->percentage,
        'grade' => $request->grade,
        'status' => $request->status,
        'remark' => $request->remark,
    ]);

    return redirect()->route('results.generate')->with('success', 'Result generated successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Result $result)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Result $result)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Result $result)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Result $result)
    {
        //
    }
}
