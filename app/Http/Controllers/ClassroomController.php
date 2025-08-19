<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $classes = Classroom::all();
        return view('admin.classroom.index',compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.classroom.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
       $request->validate([
            'name' => 'required|string|min:3|unique:classrooms,name',
        ]);
        Classroom::create([
            'name' =>$request->name,
        ]);
        return redirect()->route('classroom.index')->with('success','Class Created Successfully!!!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Classroom $classroom)
    {
        //
        
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classroom $classroom)
    {
        //
         
         return view('admin.classroom.edit',compact('classroom'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Classroom $classroom)
    {
        //

        $request->validate([
            'name' => 'required|string|min:3|unique:classrooms,name,'.$classroom->id,
        ]);

        $classroom->update([
            'name'=> $request->name
        ]);
        return redirect()->route('classroom.index')->with('success','Class Name Updated Successfully!!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classroom $classroom)
    {
        //
        $classroom->delete();
        return redirect()->route('classroom.index')->with('success','Class Name Deleted Successfully!!!');
    }
}
