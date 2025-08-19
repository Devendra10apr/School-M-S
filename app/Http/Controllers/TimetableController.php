<?php

namespace App\Http\Controllers;

use App\Models\AssignedSubject;
use App\Models\Classroom;
use App\Models\Section;
use App\Models\Timetable;
use Illuminate\Http\Request;



class TimetableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $timetables = Timetable::with('classroom','section','subject','teacher')->get();
        return view('admin.timetable.index',compact('timetables'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $classrooms = Classroom::all();
        // $sections = Section::all();
        $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
        return view('admin.timetable.create', compact('classrooms', 'days'));
    }

    public function getSections($classroomId)
    {
        $sections = Section::where('classroom_id', $classroomId)->get();
        return response()->json($sections);
    }



    public function getSubjectsAndTeachers(Request $request)
    {
        $classroomId = $request->classroom_id;
        $sectionId = $request->section_id;
        $subjectId = $request->subject_id;

        $query = AssignedSubject::with(['subject', 'teacher'])
            ->where('classroom_id', $classroomId)
            ->where('section_id', $sectionId);

        if ($subjectId) {
            $query->where('subject_id', $subjectId); // Filter by selected subject
        }

        $assignments = $query->get();

        // If subjectId is not sent, return both
        if (!$subjectId) {
            $subjects = $assignments->map(function ($item) {
                return [
                    'id' => $item->subject_id,
                    'name' => $item->subject->name
                ];
            })->unique('id')->values();

            $teachers = $assignments->map(function ($item) {
                return [
                    'id' => $item->teacher_id,
                    'name' => $item->teacher->name
                ];
            })->unique('id')->values();

            return response()->json([
                'subjects' => $subjects,
                'teachers' => $teachers
            ]);
        }

        // If subjectId is sent, return only filtered teachers
        $teachers = $assignments->map(function ($item) {
            return [
                'id' => $item->teacher_id,
                'name' => $item->teacher->name
            ];
        })->unique('id')->values();

        return response()->json([
            'teachers' => $teachers
        ]);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'classroom_id' => 'required|exists:classrooms,id',
            'section_id' => 'required|exists:sections,id',
            'subject_id' => 'required|exists:subjects,id',
            'teacher_id' => 'required|exists:users,id',
            'day' => 'required|in:monday,tuesday,wednesday,thursday,friday,saturday,sunday',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        // Optional: prevent duplicate entry for same class/section/subject/day/time
        $conflict = Timetable::where([
            'classroom_id' => $validated['classroom_id'],
            'section_id' => $validated['section_id'],
            'day' => $validated['day'],
        ])
            ->where(function ($query) use ($validated) {
                $query->whereBetween('start_time', [$validated['start_time'], $validated['end_time']])
                    ->orWhereBetween('end_time', [$validated['start_time'], $validated['end_time']]);
            })
            ->exists();

        if ($conflict) {
            return back()->withErrors(['conflict' => 'Timetable conflict detected. Please choose another time.'])->withInput();
        }


        Timetable::create($validated);

        return redirect()->route('timetables.index')->with('success' . '🕒 Timetable created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Timetable $timetable)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Timetable $timetable)
    {
        //
        $classrooms =Classroom::all();
        $days = ['monday','tuesday','wednesday','thursday','friday','saturday','sunday'];
        return view('admin.timetable.edit',compact('timetable','classrooms','days'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Timetable $timetable)
    {
        //
        $validated = $request->validate([
            'classroom_id' => 'required|exists:classrooms,id',
            'section_id' => 'required|exists:sections,id',
            'subject_id' => 'required|exists:subjects,id',
            'teacher_id' => 'required|exists:users,id',
            'day' => 'required|in:monday,tuesday,wednesday,thursday,friday,saturday,sunday',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

         $conflict = Timetable::where([
            'classroom_id' => $validated['classroom_id'],
            'section_id' => $validated['section_id'],
            'day' => $validated['day'],
        ])
            ->where(function ($query) use ($validated) {
                $query->whereBetween('start_time', [$validated['start_time'], $validated['end_time']])
                    ->orWhereBetween('end_time', [$validated['start_time'], $validated['end_time']]);
            })
            ->exists();

        if ($conflict) {
            return back()->withErrors(['conflict' => 'Timetable conflict detected. Please choose another time.'])->withInput();
        }

        $timetable->update($validated);

        return redirect()->route('timetables.index')->with('success',' 🕒 Timetable Details Upadeted Successfully!!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Timetable $timetable)
    {
        //
        $timetable->delete();

        return redirect()->back()->with('success','Timetable details Deleted successfully!!!');
    }
}
