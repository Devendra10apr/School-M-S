<?php

namespace App\Http\Controllers;

use App\Models\AssignedFee;
use App\Models\Classroom;
use App\Models\FeeType;
use App\Models\Section;
use App\Models\StudentProfile;
use App\Models\User;
use Illuminate\Http\Request;

class AssignedFeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     * 
     */

    public function getSections(Request $request)
    {
        $sections = Section::where('classroom_id', $request->classroom_id)->get();
        return response()->json($sections);
    }

    public function getStudents(Request $request)
    {
        $students = User::whereHas('studentProfile', function ($q) use ($request) {
            $q->where('classroom_id', $request->classroom_id)
                ->where('section_id', $request->section_id);
        })->whereHas('roles', function ($q) {
            $q->where('name', 'student');
        })->get(['id', 'name']);

        return response()->json($students);
    }

    public function getStudentRollNo(Request $request)
    {
        $profile = StudentProfile::where('student', $request->student_id)->first();
        return response()->json([
            'roll_no' => $profile ? $profile->roll_no : ''
        ]);
    }
    public function create()
    {
        //
        $classrooms = Classroom::all();
        $student_id = User::hasRoles('student')->get();
        $feeTypes = FeeType::with('feeCategory')->get();
        return view('admin.fee-assign.create', compact('classrooms', 'student_id', 'feeTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(AssignedFee $assignedFee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AssignedFee $assignedFee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AssignedFee $assignedFee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AssignedFee $assignedFee)
    {
        //
    }
}
