<?php

namespace App\Http\Controllers;

use App\Models\FeeCategory;
use App\Models\FeeType;
use Illuminate\Http\Request;

use function PHPUnit\Framework\returnSelf;

class FeeTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $fee_types = FeeType::with('feeCategory')->get();
        return view('admin.fee-type.index', compact('fee_types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = FeeCategory::where('status', 'active')->get();
        return view('admin.fee-type.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        // dd($request->all());
        $validated = $request->validate([
            'fee_type_id' => 'required|exists:fee_categories,id',
            'name' => 'required|string|unique:fee_types,name',
            'amount' => 'numeric|required',
            'due_date' => 'date|nullable',
            'late_fee' => 'required|numeric',
            'status' => 'required|in:active,inactive',
        ]);

        FeeType::create($validated);

        return redirect()->route('fee_type.index')->with('success', 'Fee Type data created successfully!!!');
    }

    /**
     * Display the specified resource.
     */
    public function show(FeeType $feeType)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FeeType $feeType)
    {
        //
         $categories = FeeCategory::where('status', 'active')->get();
        return view('admin.fee-type.edit',compact('feeType','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FeeType $feeType)
    {
        //
         $validated = $request->validate([
            'fee_type_id' => 'required|exists:fee_categories,id',
            'name' => 'required|string|unique:fee_types,name,'.$feeType->id,
            'amount' => 'numeric|required',
            'due_date' => 'date|nullable',
            'late_fee' => 'required|numeric',
            'status' => 'required|in:active,inactive',
        ]);
        $feeType->update( $validated );
        return redirect()->route('fee_type.index')->with('success','Fee Type Details Update successfully!!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FeeType $feeType)
    {
        //
        $feeType->delete();
        return redirect()->back()->with('success','Fee Type Details Deleted Successfully!!!');
    }
}
