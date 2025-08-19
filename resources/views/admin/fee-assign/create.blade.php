@extends('layouts.master')

@section('title', 'Fee Type')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Create Fee Type</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="#">Fee Type Name</a></li>
        <li class="breadcrumb-item active">Create Fee Type</li>
    </ol>

    <div class="card mb-4">
        <div class="card-body">
            <form action="" method="POST">
                @csrf
                <div class="row">
                    <!-- Class Select -->
                    <div class="col-md-6 mb-3">      
                        <label for="classroom_id" class="form-label">Class Name</label>
                        <select name="classroom_id" id="classroom_id" class="form-control">
                            <option value="" disabled selected>--Select Class--</option>
                            @foreach($classrooms as $class)
                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                            @endforeach
                        </select>
                        @error('classroom_id')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Section Select -->
                    <div class="col-md-6 mb-3">
                        <label for="section_id" class="form-label">Section</label>
                        <select name="section_id" id="section_id" class="form-control">
                            <option value="" disabled selected>--Select Section--</option>
                        </select>
                        @error('section_id')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Student Select -->
                    <div class="mb-3">
                        <label for="student_id" class="form-label">Student Name</label>
                        <select name="student_id" id="student_id" class="form-control">
                            <option value="" disabled selected>--Select Student--</option>
                        </select>
                        @error('student_id')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Roll No Auto Fill -->
                    <div class="mb-3">
                        <label for="roll_no" class="form-label">Roll No</label>
                        <input type="text" name="roll_no" id="roll_no"
                            class="form-control @error('roll_no') is-invalid @enderror"
                            value="{{ old('roll_no') }}" readonly>
                        @error('roll_no')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Create Fee Type</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Load sections when classroom is selected
    $('#classroom_id').change(function() {
        var classId = $(this).val();
        $('#section_id').html('<option>Loading...</option>');
        $.ajax({
            url: '{{ route("getSections") }}',
            type: 'GET',
            data: { classroom_id: classId },
            success: function(data) {
                $('#section_id').empty().append('<option disabled selected>--Select Section--</option>');
                $.each(data, function(key, section) {
                    $('#section_id').append('<option value="'+ section.id +'">'+ section.name +'</option>');
                });
            }
        });
    });

    // Load students when section is selected
    $('#section_id').change(function() {
        var classId = $('#classroom_id').val();
        var sectionId = $(this).val();
        $('#student_id').html('<option>Loading...</option>');
        $.ajax({
            url: '{{ route("getStudents") }}',
            type: 'GET',
            data: {
                classroom_id: classId,
                section_id: sectionId
            },
            success: function(data) {
                $('#student_id').empty().append('<option disabled selected>--Select Student--</option>');
                $.each(data, function(key, student) {
                    $('#student_id').append('<option value="'+ student.id +'">'+ student.name +'</option>');
                });
            }
        });
    });

    // Load roll number when student is selected
    $('#student_id').change(function() {
        var studentId = $(this).val();
        $.ajax({
            url: '{{ route("getStudentRollNo") }}',
            type: 'GET',
            data: { student_id: studentId },
            success: function(data) {
                $('#roll_no').val(data.roll_no);
            }
        });
    });
});
</script>
@endpush
