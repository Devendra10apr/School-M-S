<?php

namespace App\Http\Controllers;

use App\Models\ExamType;
use Illuminate\Http\Request;

class ExamTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $examtypes = ExamType::all();
        return view('admin.exam-type.index',compact('examtypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.exam-type.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'name'=>'required|string|max:256|unique:exam_types,name,id',
            'description'=>'nullable|string|max:256',
            'status'=>'required|in:active,inactive'
        ]);

        ExamType::create($validated);
        return redirect()->route('exam-types.index')->with('success','Exam type created successfully!!!');
    }

    /**
     * Display the specified resource.
     */
    public function show(ExamType $examType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ExamType $examType)
    {
        //
       
        return view('admin.exam-type.edit',compact('examType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ExamType $examType)
    {
        //
        $validated = $request->validate([
            'name'=>'required|string|max:256|unique:exam_types,name,' .$examType->id,
            'description'=>'nullable|string|max:256',
            'status'=>'required|in:active,inactive'
        ]);
        $examType->update($validated);
        return redirect()->route('exam-types.index')->with('success','Exam Type Details Updated Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExamType $examType)
    {
        //
        $examType->delete();
        return redirect()->back()->with('success','Exam type Deleted Successfully!!');
    }
}
