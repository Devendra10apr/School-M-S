@extends('layouts.master')

@section('title', 'Generate Result')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">🎯 Generate Result</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="">Results</a></li>
        <li class="breadcrumb-item active">Generate</li>
    </ol>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('results.fetch.students') }}" method="GET">
                @csrf
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Exam Type</label>
                        <select name="exam_type_id" class="form-control" required>
                            <option value="" disabled selected>-Select Exam-</option>
                            @foreach ($examTypes as $exam)
                            <option value="{{ $exam->id }}">{{ $exam->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Classroom</label>
                        <select name="classroom_id" id="classroomDropdown" class="form-control" required>
                            <option value="" disabled selected>-Select Class-</option>
                            @foreach ($classrooms as $class)
                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Section</label>
                        <select name="section_id" id="sectionDropdown" class="form-control" required>
                            <option value="" disabled selected>-Select Section-</option>
                        </select>
                    </div>
                </div>

                <div class="text-end">
                    <button class="btn btn-primary">📊 Show Students</button>
                </div>
            </form>
        </div>
    </div>


    @if(isset($students) && count($students) > 0)
    <td></td>
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5>👩‍🎓 Students List</h5>
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Roll No</th>
                        <th>Name</th>
                        <th>Exam Type</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($students as $student)
                    <tr>
                        <td>{{ $student->roll_no }}</td>
                        <td>{{ $student->student->name ?? 'N/A' }}</td>
                        <td>{{$selected_exam_type_name}}</td>
                        <td>
                            <a href="{{ route('results.create') }}?student_id={{ $student->student_id }}&exam_type_id={{ $selected_exam_type_id }}&classroom_id={{ $selected_classroom_id }}&section_id={{ $selected_section_id }}"
                                class="btn btn-sm btn-success">
                                Generate Result
                            </a>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
    // Get Sections on Classroom change
    $('#classroomDropdown').on('change', function () {
        let classroomId = $(this).val();
        $('#sectionDropdown').html('<option disabled selected>Loading...</option>');

        fetch(`/get-sections/${classroomId}`)
            .then(response => response.json())
            .then(data => {
                $('#sectionDropdown').empty().append('<option disabled selected>-Select Section-</option>');
                data.forEach(section => {
                    $('#sectionDropdown').append(`<option value="${section.id}">${section.name}</option>`);
                });
            });
    });
</script>
@endpush