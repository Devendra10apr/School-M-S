<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subject::all();
        return view('admin.subject.index',compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.subject.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name'=>'required|string|unique:subjects,name,',
            'code'=>'nullable|string|unique:subjects,code,',
        ]);

        Subject::create([
            'name'=>$request->name,
            'code'=>$request->code,
        ]);
        return redirect()->route('subject.index')->with('success','subject Created Successfully!!!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subject $subject)
    {
        return view('admin.subject.edit',compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subject $subject)
    {
        //
        $request->validate([
            'name'=>'required|string|unique:subjects,name,'.$subject->id,
            'code'=>'nullable|string|unique:subjects,code,'.$subject->id,
        ]);
        $subject->update([
            'name'=>$request->name,
            'code'=>$request->code,
        ]);


        // $subject->name=$request->name;
        // $subject->code=$request->code;
        // $subject->save();

        return redirect()->route('subject.index')->with('success','Subject Updated Successfully!!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        //
        $subject->delete();
        return redirect()->route('subject.index')->with('success','subject Deleted Successfully!!');
    }
}
