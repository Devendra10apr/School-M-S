@extends('layouts.master')

@section('title', 'View Attendance')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">View Attendance</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="">Attendance</a></li>
        <li class="breadcrumb-item active">View Attendance</li>
    </ol>

    {{-- <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($date)->format('d M, Y') }}</p> --}}

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Student</th>
                <th>Class</th>
                <th>Section</th>
                <th>Roll No</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($records as $record)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $record->student->name ?? '-' }}</td>
                    <td>{{ $record->classroom->name ?? '-' }}</td>
                    <td>{{ $record->section->name ?? '-' }}</td>
                    <td>{{ $record->roll_no ?? '-' }}</td>
                    <td>
                        <span class="badge bg-{{ $record->status == 'present' ? 'success' : 'danger' }}">
                            {{ ucfirst($record->status) }}
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
