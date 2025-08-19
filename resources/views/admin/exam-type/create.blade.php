@extends('layouts.master')

@section('title', 'Add Timetable')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <h1 class="text-primary fw-bold mb-0">🕒 Add Timetable</h1>
    </div>

    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="">Timetables</a></li>
        <li class="breadcrumb-item active">New timetable</li>
    </ol>

    <div class="card shadow-sm rounded">
        <div class="card-body py-4">
            @if ($errors->any())
                @foreach ($errors->all() as $msg)
                    <div class="text-danger">{{ $msg }}</div>
                @endforeach
            @endif

            <form action="{{route('timetables.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <h4 class="text-secondary border-bottom pb-2 mb-4">🕒 Add Timetable Information</h4>
                <div class="row">
                    <!-- Classroom -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Classroom</label>
                        <select name="classroom_id" id="classroomDropdown" class="form-control">
                            <option value="" selected disabled>-Select-</option>
                            @foreach ($classrooms as $classroom)
                                <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Section -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Section</label>
                        <select name="section_id" id="sectionDropdown" class="form-control">
                            <option value="" selected disabled>-Select-</option>
                        </select>
                    </div>

                    <!-- Subject -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Subject</label>
                        <select name="subject_id" id="subject_id" class="form-control">
                            <option value="" selected disabled>-Select-</option>
                        </select>
                    </div>

                    <!-- Teacher -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Teacher</label>
                        <select name="teacher_id" id="teacher_id" class="form-control">
                            <option value="" selected disabled>-Select-</option>
                        </select>
                    </div>

                    <!-- Days -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Days</label>
                        <select name="day" class="form-control">
                            <option value="" selected disabled>-Select-</option>
                            @foreach ($days as $day)
                                <option value="{{ $day }}">{{ ucfirst($day) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Start Time -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Start Time</label>
                        <input type="time" name="start_time" class="form-control">
                    </div>

                    <!-- End Time -->
                    <div class="col-md-12 mb-3">
                        <label class="form-label">End Time</label>
                        <input type="time" name="end_time" class="form-control">
                    </div>
                </div>

                <div class="text-end">
                    <button class="btn btn-primary px-4 mt-4">✅ Create Timetable</button>
                </div>
            </form>
        </div>
    </div>
    <hr class="mb-3">
</div>
@endsection

@push('scripts')
<script>
    // Fetch Sections on Classroom change
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

    // Fetch Subjects and Teachers on Classroom & Section change
    $('#classroomDropdown, #sectionDropdown').on('change', function () {
        let classroomId = $('#classroomDropdown').val();
        let sectionId = $('#sectionDropdown').val();

        if (classroomId && sectionId) {
            $.ajax({
                url: '{{ route("get.subjects.teachers") }}',
                type: 'GET',
                data: {
                    classroom_id: classroomId,
                    section_id: sectionId
                },
                success: function (res) {
                    $('#subject_id').empty().append('<option disabled selected>-- Select Subject --</option>');
                    $('#teacher_id').empty().append('<option disabled selected>-- Select Teacher --</option>');

                    $.each(res.subjects, function (key, subject) {
                        $('#subject_id').append(`<option value="${subject.id}">${subject.name}</option>`);
                    });

                    $.each(res.teachers, function (key, teacher) {
                        $('#teacher_id').append(`<option value="${teacher.id}">${teacher.name}</option>`);
                    });
                }
            });
        }
    });

    // Filter Teachers on Subject change
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
                    $.each(res.teachers, function (key, teacher) {
                        $('#teacher_id').append(`<option value="${teacher.id}">${teacher.name}</option>`);
                    });
                }
            });
        }
    });
</script>
@endpush
