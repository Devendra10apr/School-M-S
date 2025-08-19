@extends('layouts.master')

@section('title', 'Timetable')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Timetable Details</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard / Timtable</li>
    </ol>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card mb-4 shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-table me-1"></i> Timetable
            </div>
            <a href="{{ route('timetables.create') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus"></i> Create New Timetable
            </a>
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th>Classroom</th>
                        <th>Section </th>
                        <th>Subject</th>
                        <th>Teacher</th>
                        <th>Days</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th style="width: 150px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($timetables as $data )
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$data->classroom->name}}</td>
                        <td>{{$data->section->name}}</td>
                        <td>{{$data->subject->name}}</td>
                        <td>{{$data->teacher->name}}</td>
                        <td>{{$data->day}}</td>
                        <td>{{$data->start_time}} {{$data->end_time}} </td>
                        <td>{{$data->status}}</td>
                        <td class="text-nowrap">
                            <div class="d-flex gap-2">
                                <a href="{{ route('timetables.edit', $data->id) }}"
                                    class="btn btn-sm btn-warning">
                                    ✏️ Edit
                                </a>

                                <form action="{{ route('timetables.destroy', $data->id) }}" method="POST"
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
                        <th>Classroom</th>
                        <th>Section </th>
                        <th>Subject</th>
                        <th>Teacher</th>
                        <th>Days</th>
                        <th>Time</th>
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