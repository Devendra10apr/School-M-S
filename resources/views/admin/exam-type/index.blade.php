@extends('layouts.master')

@section('title', 'Exam Types')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">📚 Exam Types</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard / Exam Types</li>
    </ol>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>All Exam Types</span>
            <a href="{{ route('exam-types.create') }}" class="btn btn-primary btn-sm">➕ Add Exam Type</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th width="180">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($examtypes as $type)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $type->name }}</td>
                        <td>{{ $type->description }}</td>
                        <td>
                            <span class="badge bg-{{ $type->status == 'active' ? 'success' : 'secondary' }}">
                                {{ ucfirst($type->status) }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('exam-types.edit', $type->id) }}" class="btn btn-warning btn-sm">✏️ Edit</a>
                                <form action="{{ route('exam-types.destroy', $type->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">🗑️ Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach

                    @if($examtypes->count() == 0)
                    <tr>
                        <td colspan="5" class="text-center text-muted">No exam types found.</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
