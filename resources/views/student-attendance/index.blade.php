@extends('layouts.master')

@section('title', 'Attendance')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Attendance {{ \Carbon\Carbon::today()->format('F j, Y') }}</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard / Attendance</li>
    </ol>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card mb-4 shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-table me-1"></i> Attendance
            </div>
            <a href="{{ route('assignedSubject.create') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus"></i> Attendance
            </a>
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th>Class Name</th>
                        
                        <th>Section </th>
                        <th>Teacher</th>
                        <th>Date</th>
                        <th style="width: 150px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach ($assignteacher as $data )
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$data->class->name}}</td>
                        
                        <td>{{$data->section->name}}</td>
                        <td>{{$data->teacher->name}}</td>
                        <td>{{now()->format('d M y')}}</td>
                        <td>
                           @if ($data->is_taken)
                                <a href="{{ route('student.attendance.view', [
                                    'classroom_id' => $data->classroom_id,
                                    'section_id' => $data->section_id,
                                    'date' => now()->toDateString()
                                ]) }}" class="btn btn-secondary btn-sm">👁️ View Attendance</a>
                            @else
                                <a href="{{ route('studentAttendance.create', [
                                    'classroom_id' => $data->classroom_id,
                                    'section_id' => $data->section_id
                                ]) }}" class="btn btn-success btn-sm">📅 Take Attendance</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot class="table-light">
                    <tr>
                        <tr>
                        <th style="width: 50px;">#</th>
                        <th>Class Name</th>
                    
                        <th>Section </th>
                        <th>Teacher</th>
                        <th style="width: 150px;">Action</th>
                    </tr>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
