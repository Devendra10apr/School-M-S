@extends('layouts.master')

@section('title', 'Update Timetable')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <h1 class="text-primary fw-bold mb-0">🕒 Update Timetable</h1>
    </div>

    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('timetables.index') }}">Timetables</a></li>
        <li class="breadcrumb-item active">Update timetable</li>
    </ol>

    <div class="card shadow-sm rounded">
        <div class="card-body py-4">
            @if ($errors->any())
                @foreach ($errors->all() as $msg)
                    <div class="text-danger">{{ $msg }}</div>
                @endforeach
            @endif

            <form action="{{ route('timetables.update', $timetable->id) }}" method="POST">
                @csrf
                @method('PUT')

                <h4 class="text-secondary border-bottom pb-2 mb-4">🕒 Update Timetable Information</h4>
                <div class="row">
                    <!-- Classroom -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Classroom</label>
                        <select name="classroom_id" id="classroomDropdown" class="form-control">
                            <option value="" disabled>-Select-</option>
                            @foreach ($classrooms as $classroom)
                                <option value="{{ $classroom->id }}" {{ $classroom->id == $timetable->classroom_id ? 'selected' : '' }}>
                                    {{ $classroom->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Section -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Section</label>
                        <select name="section_id" id="sectionDropdown" class="form-control">
                            <option value="" disabled selected>-Select-</option>
                        </select>
                    </div>

                    <!-- Subject -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Subject</label>
                        <select name="subject_id" id="subject_id" class="form-control">
                            <option value="" disabled selected>-Select-</option>
                        </select>
                    </div>

                    <!-- Teacher -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Teacher</label>
                        <select name="teacher_id" id="teacher_id" class="form-control">
                            <option value="" disabled selected>-Select-</option>
                        </select>
                    </div>

                    <!-- Days -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Days</label>
                        <select name="day" class="form-control">
                            <option value="" disabled>-Select-</option>
                            @foreach ($days as $day)
                                <option value="{{ $day }}" {{ $timetable->day == $day ? 'selected' : '' }}>
                                    {{ ucfirst($day) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Start Time -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Start Time</label>
                        <input type="time" name="start_time" class="form-control" value="{{ $timetable->start_time }}">
                    </div>

                    <!-- End Time -->
                    <div class="col-md-12 mb-3">
                        <label class="form-label">End Time</label>
                        <input type="time" name="end_time" class="form-control" value="{{ $timetable->end_time }}">
                    </div>
                </div>

                <div class="text-end">
                    <button class="btn btn-success px-4 mt-4">🔄 Update Timetable</button>
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
    const selectedClassroom = "{{ $timetable->classroom_id }}";
    const selectedSection = "{{ $timetable->section_id }}";
    const selectedSubject = "{{ $timetable->subject_id }}";
    const selectedTeacher = "{{ $timetable->teacher_id }}";

    // Load Sections on page load
    if (selectedClassroom) {
        fetch(`/get-sections/${selectedClassroom}`)
            .then(response => response.json())
            .then(sections => {
                $('#sectionDropdown').empty().append('<option disabled>-Select-</option>');
                sections.forEach(section => {
                    $('#sectionDropdown').append(`<option value="${section.id}" ${section.id == selectedSection ? 'selected' : ''}>${section.name}</option>`);
                });

                // Then load subjects and teachers
                loadSubjectsAndTeachers(selectedClassroom, selectedSection, selectedSubject, selectedTeacher);
            });
    }

    // Function to populate subjects and teachers
    function loadSubjectsAndTeachers(classroomId, sectionId, subjectId = null, teacherId = null) {
        $.ajax({
            url: '{{ route("get.subjects.teachers") }}',
            type: 'GET',
            data: { classroom_id: classroomId, section_id: sectionId },
            success: function (res) {
                $('#subject_id').empty().append('<option disabled selected>-- Select Subject --</option>');
                $('#teacher_id').empty().append('<option disabled selected>-- Select Teacher --</option>');

                res.subjects.forEach(subject => {
                    $('#subject_id').append(`<option value="${subject.id}" ${subject.id == subjectId ? 'selected' : ''}>${subject.name}</option>`);
                });

                res.teachers.forEach(teacher => {
                    $('#teacher_id').append(`<option value="${teacher.id}" ${teacher.id == teacherId ? 'selected' : ''}>${teacher.name}</option>`);
                });
            }
        });
    }

    // When Classroom changes
    $('#classroomDropdown').on('change', function () {
        let classroomId = $(this).val();
        $('#sectionDropdown').empty().append('<option disabled selected>Loading...</option>');

        fetch(`/get-sections/${classroomId}`)
            .then(response => response.json())
            .then(data => {
                $('#sectionDropdown').empty().append('<option disabled selected>-Select-</option>');
                data.forEach(section => {
                    $('#sectionDropdown').append(`<option value="${section.id}">${section.name}</option>`);
                });
            });
    });

    // When both classroom & section selected
    $('#classroomDropdown, #sectionDropdown').on('change', function () {
        let classroomId = $('#classroomDropdown').val();
        let sectionId = $('#sectionDropdown').val();
        if (classroomId && sectionId) {
            loadSubjectsAndTeachers(classroomId, sectionId);
        }
    });

    // Filter teachers based on selected subject
    $('#subject_id').on('change', function () {
        let subjectId = $(this).val();
        let classroomId = $('#classroomDropdown').val();
        let sectionId = $('#sectionDropdown').val();

        if (subjectId && classroomId && sectionId) {
            $.ajax({
                url: '{{ route("get.subjects.teachers") }}',
                type: 'GET',
                data: {
                    classroom_id: classroomId,
                    section_id: sectionId,
                    subject_id: subjectId
                },
                success: function (res) {
                    $('#teacher_id').empty().append('<option disabled selected>-- Select Teacher --</option>');
                    res.teachers.forEach(teacher => {
                        $('#teacher_id').append(`<option value="${teacher.id}">${teacher.name}</option>`);
                    });
                }
            });
        }
    });
});
</script>
@endpush
