@extends('layouts.master')

@section('title', 'Take Attendance')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Take Attendance</h1>

    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="#">Attendance</a></li>
        <li class="breadcrumb-item active">Take Attendance</li>
    </ol>

    {{-- Success Alert --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('studentAttendance.store') }}" method="POST">
                @csrf

                {{-- Hidden Class and Section --}}
                <input type="hidden" name="classroom_id" value="{{ $classroom }}">
                <input type="hidden" name="section_id" value="{{ $section }}">

                <p><strong>Date:</strong> {{ \Carbon\Carbon::today()->format('d M, Y') }}</p>

                <table id="datatablesSimple" class="table table-bordered table-striped align-middle">
                    <caption class="text-muted text-center">
                        Student Attendance for {{ \Carbon\Carbon::today()->format('d M, Y') }}
                    </caption>

                    <thead class="table-dark">
                        <tr>
                            <th style="width: 50px;">#</th>
                            <th>Student Name</th>
                            <th>Class</th>
                            <th>Section</th>
                            <th>Roll No</th>
                            <th class="text-center" style="width: 180px;">Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($students as $student)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $student->student->name }}</td>
                            <td>{{ $student->classroom->name }}</td>
                            <td>{{ $student->section->name }}</td>
                            <td>{{ $student->roll_no }}</td>
                            <td class="text-center">
                                <div class="btn-group" role="group" aria-label="Attendance Status">
                                    <input type="radio" class="btn-check" name="attendance[{{ $student->id }}]"
                                        id="present-{{ $student->id }}" value="present" checked>
                                    <label class="btn btn-outline-success btn-sm"
                                        for="present-{{ $student->id }}">Present</label>

                                    <input type="radio" class="btn-check" name="attendance[{{ $student->id }}]"
                                        id="absent-{{ $student->id }}" value="absent">
                                    <label class="btn btn-outline-danger btn-sm"
                                        for="absent-{{ $student->id }}">Absent</label>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                    <tfoot class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Student Name</th>
                            <th>Class</th>
                            <th>Section</th>
                            <th>Roll No</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </tfoot>
                </table>

                <div class="text-end mt-3">
                    <button type="submit" class="btn btn-primary">
                        📝 Submit Attendance
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
