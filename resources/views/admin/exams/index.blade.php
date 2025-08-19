@extends('layouts.master')

@section('title', 'Exam Types')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">📚 Exams</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard / Exams</li>
    </ol>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>All Exams</span>
            <a href="{{ route('exams.create') }}" class="btn btn-primary btn-sm">➕ Add Exam</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Exam Type</th>
                        <th>Classroom</th>
                        <th>Section</th>
                        <th>Subject</th>
                        <th>Exam Date</th>
                        <th>Time</th>
                        <th>Room</th>
                        <th width="180">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($exams as $exam)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $exam->examType->name ?? 'N/A' }}</td>
                        <td>{{ $exam->classroom->name ?? 'N/A' }}</td>
                        <td>{{ $exam->section->name ?? 'N/A' }}</td>
                        <td>{{ $exam->subject->name ?? 'N/A' }}</td>
                        <td>{{ \Carbon\Carbon::parse($exam->exam_date)->format('d M Y') }}</td>
                        <td>
                            {{ \Carbon\Carbon::createFromFormat('H:i:s', $exam->start_time)->format('h:i A') }}
                            -
                            {{ \Carbon\Carbon::createFromFormat('H:i:s', $exam->end_time)->format('h:i A') }}
                        </td>
                        <td>{{ $exam->room_no }}</td>
                        <td>
                            <a href="{{route('exams.edit',$exam->id)}}" class="btn btn-sm btn-success">✏️ Edit</a>
                            <form action="{{route('exams.destroy',$exam->id)}}" method="post" onclick="return confirm('Are you sure??')" style="display: inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">🗑️ Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center text-muted">No exams found.</td>
                    </tr>
                    @endforelse
                </tbody>
                
            </table>
        </div>
    </div>
</div>
@endsection
