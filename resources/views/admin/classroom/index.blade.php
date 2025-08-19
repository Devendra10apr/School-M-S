@extends('layouts.master')

@section('title', 'Classroom List')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Classroom List</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard / Classrooms</li>
    </ol>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card mb-4 shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-table me-1"></i> All Classrooms
            </div>
            <a href="{{ route('classroom.create') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus"></i> Add Class
            </a>
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th>Class Name</th>
                        <th style="width: 150px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($classes as $class)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $class->name }}</td>
                        <td>
                            <a href="{{ route('classroom.edit', $class->id ) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>

                            <form action="{{ route('classroom.destroy', $class->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
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
                        <th>#</th>
                        <th>Class Name</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
