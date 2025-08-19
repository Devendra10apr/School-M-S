@extends('layouts.master')

@section('title', 'Teacher Profile')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Teacher Profile</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard / Profile</li>
    </ol>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card mb-4 shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-table me-1"></i> Teacher Profile
            </div>
            <a href="#" class="btn btn-sm btn-primary">
                <i class="fas fa-plus"></i> Create teacher profile
            </a>
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th>Teacher Name</th>
                        <th>Email </th>
                        <th>Mobile</th>
                        <th>Addhar</th>
                        <th>Education</th>
                        <th>Subject</th>
                        <th>Status</th>
                        <th style="width: 150px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($teachers as $teacher)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$teacher->user->name}}</td>
                            <td>{{$teacher->user->email}}</td>
                            <td>{{$teacher->mobile}}</td>
                            <td>{{$teacher->aadhaar_no}}</td>
                            <td>{{$teacher->education}}</td>
                            <td>{{$teacher->subject}}</td>
                            <td>{{$teacher->status}}</td>
                            <td class="text-nowrap">
                            <div class="d-flex gap-2">
                                <a href="{{ route('teachers.edit', $teacher->id) }}"
                                    class="btn btn-sm btn-warning">
                                    ✏️ Edit
                                </a>

                                <form action="{{route('teachers.destroy',$teacher->id)}}" method="POST"
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
                        <th>Teacher Name</th>
                        <th>Email </th>
                        <th>Mobile</th>
                        <th>Addhar</th>
                        <th>Education</th>
                        <th>Subject</th>
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