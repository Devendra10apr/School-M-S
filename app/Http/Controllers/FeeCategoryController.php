<?php

namespace App\Http\Controllers;

use App\Models\FeeCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FeeCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $fee_categories = FeeCategory::all();
        return view('admin.fee-category.index',compact('fee_categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.fee-category.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'name'=>'required|string|unique:fee_categories,name,id',
            'description'=>'nullable|string',
            'status'=>'required|in:active,inactive'
        ]);

        FeeCategory::create($validated);

        return redirect()->route('fee_category.index')->with('success','Fee Category Created Successfully!!!');
    }

    /**
     * Display the specified resource.
     */
    public function show(FeeCategory $feeCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FeeCategory $feeCategory)
    {
        //
        return view('admin.fee-category.edit',compact('feeCategory'));


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FeeCategory $feeCategory)
    {
        //
       // dd($feeCategory->id);
         $validated = $request->validate([
            'name' => 'required|string|unique:fee_categories,name,' . $feeCategory->id,
            //'name'=>['required','string' Rule::unique('fee_categories','name')->$feeCategory->id],
            'description'=>'nullable|string',
            'status'=>'required|in:active,inactive'
        ]);

        $feeCategory->update($validated);
        return redirect()->route('fee_category.index')->with('success','Fee category Updated Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FeeCategory $feeCategory)
    {
        //
        $feeCategory->delete();

        return redirect()->back()->with('success','Fee Category Deleted Successfully!!!');
    }
}
