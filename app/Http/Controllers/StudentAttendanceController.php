<?php

namespace App\Http\Controllers;

use App\Models\AssignedSubject;
use App\Models\Classroom;
use App\Models\Section;
use App\Models\StudentAttendance;
use App\Models\StudentProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teacherId = Auth::id();
        $today = now()->toDateString();

        $assignteacher = AssignedSubject::with('class', 'section', 'teacher')
            ->where('teacher_id', $teacherId)
            ->get()
            ->unique(function ($item) {
                return $item->classroom_id . '-' . $item->section_id;
            })
            ->map(function ($item) use ($today) {
                $item->is_taken = StudentAttendance::where('classroom_id', $item->classroom_id)
                    ->where('section_id', $item->section_id)
                    ->whereDate('attendance_date', $today)
                    ->exists();
                return $item;
            });

        return view('student-attendance.index', compact('assignteacher'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        $classroom = $request->classroom_id;
        $section = $request->section_id;

        $students = StudentProfile::with('student')
            ->where('classroom_id', $classroom)
            ->where('section_id', $section)->get();

        return view('student-attendance.create', compact('classroom', 'section', 'students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'attendance' => 'required|array',
            'classroom_id' => 'required|exists:classrooms,id',
            'section_id' => 'required|exists:sections,id'
        ]);

        $attendancedate = now()->toDateString();

        foreach ($request->attendance as $studentId => $status)  {
            $profile = StudentProfile::findOrFail($studentId);

            StudentAttendance::updateOrCreate(
                [
                    'student_id' => $studentId,
                    'attendance_date' =>  $attendancedate
                ],
                [
                    'classroom_id' => $request->classroom_id,
                    'section_id' => $request->section_id,
                    'status' => $status,
                    'roll_no' => $profile->roll_no,
                ]
            );
        }
        return redirect()->route('studentAttendance.index')->with('success', 'Attendance saved successfully!');
    }

    /**
     * Display the specified resource.
     */
  public function attendanceView(Request $request)
{
    $classroomId = $request->classroom_id;
    $sectionId =  $request->section_id;
    $date = $request->date ?? now()->toDateString(); // small correction here too

    $records = StudentAttendance::with('student.studentProfile')
        ->where('classroom_id', $classroomId)
        ->where('section_id', $sectionId)
        ->whereDate('attendance_date', $date)
        ->get();

    return view('student-attendance.attendance-view', compact('records', 'date'));
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StudentAttendance $studentAttendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StudentAttendance $studentAttendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudentAttendance $studentAttendance)
    {
        //
    }
}
