@extends('layouts.master')
@section('content')
<div class="container mt-4">
    <h4>Students in Class-Section</h4>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Roll No</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($students as $student)
                <tr>
                    <td>{{ $student->roll_no }}</td>
                    <td>{{ $student->student->name ?? 'N/A' }}</td>
                    <td>
                        {{-- <a href="{{ route('results.create', [
                            'student_id' => $student->user_id,
                            'exam_type_id' => $examTypeId,
                            'classroom_id' => $classroomId,
                            'section_id' => $sectionId
                        ]) }}" class="btn btn-sm btn-success"> --}}
                            Generate Result
                        {{-- </a> --}}
                    </td>
                </tr>
            @empty
                <tr><td colspan="3">No students found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
