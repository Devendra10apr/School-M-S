@extends('layouts.master')

@section('title', 'Attendance')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Student Profile</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard / Profile</li>
    </ol>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card mb-4 shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-table me-1"></i> Student Profile
            </div>
            <a href="{{ route('student-profiles.create') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus"></i> Create student profile
            </a>
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th>Student Name</th>
                        <th>Class </th>
                        <th>Section</th>
                        <th>Roll No</th>
                        <th>Parent's Name</th>
                        <th>Parent's Mobile</th>
                        <th>Status</th>
                        <th style="width: 150px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($studentProfile as $data )
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$data->student->name}}</td>
                        <td>{{$data->classroom->name}}</td>
                        <td>{{$data->section->name}}</td>
                        <td>{{$data->roll_no}}</td>
                        <td>{{$data->parent->name}}</td>
                        <td>{{$data->parentdetails->parent_mobile}} </td>
                        <td>{{$data->status}}</td>
                        <td class="text-nowrap">
                            <div class="d-flex gap-2">
                                <a href="{{ route('student-profiles.edit', $data->id) }}"
                                    class="btn btn-sm btn-warning">
                                    ✏️ Edit
                                </a>

                                <form action="{{ route('student-profiles.destroy', $data->id) }}" method="POST"
                                    onsubmit="return confirm('⚠️ Are you sure you want to delete this student?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        🗑️ Delete
                                    </button>
                                </form>
                            </div>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
                <tfoot class="table-light">
                    <tr>
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th>Student Name</th>
                        <th>Class </th>
                        <th>Section</th>
                        <th>Roll No</th>
                        <th>Parent's Name</th>
                        <th>Parent's Mobile</th>
                        <th>Status</th>
                        <th style="width: 150px;">Action</th>
                    </tr>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection