@extends('layouts.master')

@section('title', 'Generate Final Result')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <h1 class="text-primary fw-bold mb-0">🏫 Generate Final Result</h1>
    </div>

    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="">Result</a></li>
        <li class="breadcrumb-item active">Generate New Result</li>
    </ol>

    <div class="card shadow-sm rounded">
        <div class="card-body py-4">

            {{-- ✅ Show all other errors --}}
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $msg)
                    <li>{{ $msg }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <h4 class="text-secondary border-bottom pb-2 mb-4"> Result </h4>

            <form action="{{ route('results.srore') }}" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- Input type hidden for store--}}
                <input type="hidden" name='student_id' value="{{$student->student_id}}">
                <input type="hidden" name='roll_number' value="{{$student->roll_no}}">
                <input type="hidden" name='classroom_id' value="{{$classroom_id}}">
                <input type="hidden" name='section_id' value="{{$section_id}}">
                <input type="hidden" name='exam_type_id' value="{{$exam_type_id}}">
                
                {{--Table all Subject marks--}}
                <div class="row mb-2 p-2">
                    <div class="col-md-6">
                        <h5>Name :- {{$student->student->name}} </h5>
                        <h5>Class :- {{$classroom->name}} </h5>
                    </div>
                    <div class="col-md-6">
                        <h5>Roll No :- {{$student->roll_no}} </h5>
                        <h5>Section :- {{$section->name}} </h5>
                    </div>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Subject</th>
                            <th>Total</th>
                            <th>Written</th>
                            <th>Practical</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($marks as $mark )
                            <tr>
                                <td>{{$mark->subject->name}}</td>
                                <td>{{$mark->total_marks}}</td>
                                <td>{{$mark->obtained_marks}}</td>
                                <td>{{$mark->practical_marks}}</td>
                            </tr>
                        @endforeach
                            <tr>
                                <td><strong>Total</strong></td>
                                <td><strong>{{$total}}</strong></td>
                                <td><strong>{{$obtained_marks}}</strong></td>
                                <td><strong>{{$practical_marks}}</strong></td>
                            </tr>
                            <tr>
                                <td colspan="2"><strong>Total Obtained  </strong>(Written + Practical)</td>
                                <td colspan="2" style="text-align: right"><strong> {{$total_obtained}}  </strong></td>
                            </tr>
                            <tr>
                                <td colspan="2"><strong>Percentage  </strong></td>
                                <td colspan="2" style="text-align: right"><strong> {{$percentage}}  </strong></td>
                            </tr>
                            <tr>
                                <td colspan="2"><strong>Grade :- {{$grade}}  </strong></td>
                                <td colspan="2" style="text-align: right"><strong>Final result :- {{$status}}  </strong></td>
                               
                            </tr>
                    </tbody>
                </table>
                {{--input field for store in database--}}
                <input type="hidden" name='total_marks' value="{{$total}}">
                <input type="hidden" name='obtained_marks' value="{{$obtained_marks}}">
                <input type="hidden" name='practical_marks' value="{{$practical_marks}}">
                <input type="hidden" name='percentage' value="{{$percentage}}">
                <input type="hidden" name='grade' value="{{$grade}}">
                <input type="hidden" name='status' value="{{$status}}">
                <label for="remark">Remarks</label>
                <textarea name="remark" id="" cols="3" rows="2" class="form-control"></textarea>

                <div class="text-end">
                    <button class="btn btn-primary px-4 mt-4">💾 Save Result</button>
                </div>
            </form>
        </div>
    </div>
    <hr class="mb-3">
</div>
@endsection