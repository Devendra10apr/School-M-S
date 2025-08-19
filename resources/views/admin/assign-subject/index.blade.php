@extends('layouts.master')

@section('title', 'Subject List')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Assign Subject List</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard / Assign Subject</li>
    </ol>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card mb-4 shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-table me-1"></i> All Assign Subject
            </div>
            <a href="{{ route('assignedSubject.create') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus"></i> Assign Subject
            </a>
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th>Class Name</th>
                        <th>Subject Name</th>
                        <th>Section </th>
                        <th>Teacher</th>
                        <th style="width: 150px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach ($assign as $data )
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$data->class->name}}</td>
                        <td>{{$data->subject->name}}</td>
                        <td>{{$data->section->name}}</td>
                        <td>{{$data->teacher->name}}</td>
                        <td>
                            <a href="{{route('assignedSubject.edit',$data->id)}}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>                               
                            </a>                               
                            <form action="{{route('assignedSubject.destroy',$data->id)}}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                               @csrf
                               @method('DELETE')
                                <button class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot class="table-light">
                    <tr>
                        <tr>
                        <th style="width: 50px;">#</th>
                        <th>Class Name</th>
                        <th>Subject Name</th>
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
