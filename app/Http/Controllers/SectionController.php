<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $classes = Section::with('classroom')->latest()->get();
        return view('admin.section.index',compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
       $classes = Classroom::all();
       return view('admin.section.create',compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'classroom_id'=> 'required|exists:classrooms,id',
         'name'=>  [
            'required',
            'string',
            Rule::unique('sections')->where(function ($query) use ($request) {
                return $query->where('classroom_id', $request->classroom_id);
            }),

         ],
        ]);

        Section::create([
            'classroom_id'=>$request->classroom_id,
            'name'=>$request->name,
        ]);

        return redirect()->route('sections.index')->with('success','Section Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section $section)
    {
        //
        $classroom = Classroom::all();
        return view('admin.section.edit',compact('section','classroom'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Section $section)
    {
        //
       $request->validate([
        'classroom_id' => 'required|exists:classrooms,id',
        'name' => [
            'required',
            'string',
            Rule::unique('sections')->where(function ($query) use ($request, $section) {
                return $query->where('classroom_id', $request->classroom_id)
                             ->where('id', '!=', $section->id); 
            }),
        ],
    ]);

        $section->update([
            'classroom_id'=>$request->classroom_id,
            'name'=>$request->name,
        ]);
        return redirect()->route('sections.index')->with('success','Section Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Section $section)
    {
        //
        $section->delete();
        return redirect()->route('sections.index')->with('success','Section Data deleted Successfully!!!');
    }
}
