@extends('layouts.master')

@section('title', 'Marks')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">📚 Marks Details</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard / Marks</li>
    </ol>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card mb-4 shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-table me-1"></i> All Marks
            </div>
            <a href="{{ route('marks.create') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus"></i> Add New Mark
            </a>
        </div>

        <div class="card-body">
            <table id="datatablesSimple" class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Exam Type</th>
                        <th>Classroom</th>
                        <th>Section</th>
                        <th>Subject</th>
                        <th>Student Name</th>
                        <th>Total Marks</th>
                        <th>Written Marks</th>
                        <th>Practical Marks</th>
                        <th>Remarks</th>
                        <th>Status</th>
                        <th style="width: 150px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($marks as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->examType->name ?? 'N/A' }}</td>
                        <td>{{ $data->classroom->name ?? 'N/A' }}</td>
                        <td>{{ $data->section->name ?? 'N/A' }}</td>
                        <td>{{ $data->subject->name ?? 'N/A' }}</td>
                        <td>{{ $data->student->name ?? 'N/A' }}</td>
                        <td>{{ $data->total_marks }}</td>
                        <td>{{ $data->obtained_marks }}</td>
                        <td>{{ $data->practical_marks }}</td>
                        <td>{{ $data->remarks ?? '-' }}</td>
                        <td>
                            @if($data->status == 'active')
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>
                        <td class="text-nowrap">
                            <div class="d-flex gap-2">
                                <a href="{{route('marks.edit',$data->id)}}" class="btn btn-sm btn-warning">✏️ Edit</a>
                                <form action="{{route('marks.destroy',$data->id)}}" method="POST" onsubmit="return confirm('⚠️ Are you sure you want to delete this mark?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">🗑️ Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

                <tfoot class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Exam Type</th>
                        <th>Classroom</th>
                        <th>Section</th>
                        <th>Subject</th>
                        <th>Student Name</th>
                        <th>Total Marks</th>
                        <th>Written Marks</th>
                        <th>Practical Marks</th>
                        <th>Remarks</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
