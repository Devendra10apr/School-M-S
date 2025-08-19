@extends('layouts.master')

@section('title', 'add mark')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <h1 class="text-primary fw-bold mb-0">🏫 Mark</h1>
    </div>

    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="">Mark</a></li>
        <li class="breadcrumb-item active">New mark</li>
    </ol>

    <div class="card shadow-sm rounded">
        <div class="card-body py-4">

            {{-- ✅ Show custom duplicate error --}}
            @if ($errors->has('duplicate'))
                <div class="alert alert-danger">
                    {{ $errors->first('duplicate') }}
                </div>
            @endif

            {{-- ✅ Show all other errors --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $msg)
                            <li>{{ $msg }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('marks.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <h4 class="text-secondary border-bottom pb-2 mb-4">🏫 Add Student Marks</h4>
                <div class="row">

                    {{-- Exam Type --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Exam Type</label>
                        <select name="exam_type_id" class="form-control @error('exam_type_id') is-invalid @enderror">
                            <option value="" disabled selected>-Select-</option>
                            @foreach ($exam_types as $examtype)
                                <option value="{{ $examtype->id }}" {{ old('exam_type_id') == $examtype->id ? 'selected' : '' }}>
                                    {{ $examtype->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('exam_type_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Classroom --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Classroom</label>
                        <select name="classroom_id" id="classroomDropdown" class="form-control @error('classroom_id') is-invalid @enderror">
                            <option value="" disabled selected>-Select-</option>
                            @foreach ($classrooms as $classroom)
                                <option value="{{ $classroom->id }}" {{ old('classroom_id') == $classroom->id ? 'selected' : '' }}>
                                    {{ $classroom->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('classroom_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Section --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Section</label>
                        <select name="section_id" id="sectionDropdown" class="form-control @error('section_id') is-invalid @enderror">
                            <option value="" disabled selected>-Select-</option>
                        </select>
                        @error('section_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Subject --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Subject</label>
                        <select name="subject_id" class="form-control @error('subject_id') is-invalid @enderror">
                            <option value="" disabled selected>-Select-</option>
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
                                    {{ $subject->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('subject_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Student --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Student</label>
                        <select name="student_id" id="student_id" class="form-control @error('student_id') is-invalid @enderror">
                            <option value="" disabled selected>-Select-</option>
                        </select>
                        @error('student_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Marks --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Total Marks</label>
                        <input type="number" step="0.01" name="total_marks" class="form-control @error('total_marks') is-invalid @enderror" value="{{ old('total_marks') }}">
                        @error('total_marks') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Written Marks</label>
                        <input type="number" step="0.01" name="obtained_marks" class="form-control @error('obtained_marks') is-invalid @enderror" value="{{ old('obtained_marks') }}">
                        @error('obtained_marks') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Practical Marks</label>
                        <input type="number" step="0.01" name="practical_marks" class="form-control @error('practical_marks') is-invalid @enderror" value="{{ old('practical_marks') }}">
                        @error('practical_marks') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-label">Remarks</label>
                        <input type="text" name="remarks" class="form-control @error('remarks') is-invalid @enderror" value="{{ old('remarks') }}">
                        @error('remarks') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                </div>

                <div class="text-end">
                    <button class="btn btn-primary px-4 mt-4">✅ Add Marks</button>
                </div>
            </form>
        </div>
    </div>
    <hr class="mb-3">
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        // Load Sections on Classroom change
        $('#classroomDropdown').on('change', function () {
            let classroomId = $(this).val();
            $('#sectionDropdown').empty().append('<option disabled selected>Loading...</option>');
            $('#student_id').empty().append('<option disabled selected>Select Section First</option>');

            fetch(`/get-sections/${classroomId}`)
                .then(response => response.json())
                .then(data => {
                    $('#sectionDropdown').empty().append('<option disabled selected>-Select-</option>');
                    data.forEach(section => {
                        $('#sectionDropdown').append(`<option value="${section.id}">${section.name}</option>`);
                    });
                });
        });

        // Load Students on Section change
        $('#sectionDropdown').on('change', function () {
            let classroomId = $('#classroomDropdown').val();
            let sectionId = $(this).val();

            if (!classroomId || !sectionId) return;

            $('#student_id').empty().append('<option disabled selected>Loading...</option>');

            fetch(`/get-students/${classroomId}/${sectionId}`)
                .then(res => res.json())
                .then(data => {
                    $('#student_id').empty();
                    if (data.length === 0) {
                        $('#student_id').append('<option disabled selected>No students found</option>');
                    } else {
                        $('#student_id').append('<option disabled selected>-Select-</option>');
                        data.forEach(student => {
                            $('#student_id').append(`<option value="${student.id}">${student.name}</option>`);
                        });
                    }
                });
        });
    });
</script>
@endpush
