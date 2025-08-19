@extends('layouts.master')

@section('title', 'Create Exam Type')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">➕ Exam </h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('exam-types.index') }}">Exam </a></li>
        <li class="breadcrumb-item active">Create</li>
    </ol>

    <div class="card shadow-sm">
        <div class="card-body">

            @if ($errors->any())
            @foreach ($errors->all() as $msg)
            <li class="text-danger">{{ $msg }}</li>
            @endforeach
            @endif

            <form action="{{ route('exams.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Exam Type Name <span class="text-danger">*</span></label>
                        <select name="exam_type_id" id="" class="form-control">
                            <option value="" disabled selected>-Selected-</option>
                            @foreach ($exam_types as $exam_type)
                            <option value="{{$exam_type->id}}">{{$exam_type->name}}</option>
                            @endforeach

                            @error('exam_type_id') <small class="text-danger">{{ $message }}</small> @enderror
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label"> Class Name <span class="text-danger">*</span></label>
                        <select name="classroom_id" id="classroomDropdown" class="form-control">
                            <option value="" disabled selected>-Selected-</option>
                            @foreach ($classrooms as $classroom)
                            <option value="{{$classroom->id}}">{{$classroom->name}}</option>
                            @endforeach

                            @error('classroom_id') <small class="text-danger">{{ $message }}</small> @enderror
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label"> Section <span class="text-danger">*</span></label>
                        <select name="section_id" id="sectionDropdown" class="form-control">
                            <option value="" disabled selected>-Selected-</option>
                            @error('section_id') <small class="text-danger">{{ $message }}</small> @enderror
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label"> Subject <span class="text-danger">*</span></label>
                        <select name="subject_id" id="" class="form-control">
                            <option value="" disabled selected>-Selected-</option>
                            @foreach ($subjects as $subject )
                            <option value="{{$subject->id}}">{{$subject->name}}</option>
                            @endforeach
                            @error('subject_id') <small class="text-danger">{{ $message }}</small> @enderror
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label"> Exam Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" name="exam_date">
                        @error('exam_date') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label"> Start Time <span class="text-danger">*</span></label>
                        <input type="time" class="form-control" name="start_time">
                        @error('start_time') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label"> End Time <span class="text-danger">*</span></label>
                        <input type="time" class="form-control" name="end_time">
                        @error('end_time') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label"> Room No <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="room_no">
                        @error('room_no') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    

                    <div class="col-md-12 mb-3">
                        <label class="form-label">Status <span class="text-danger">*</span></label>
                        <select name="status" id="status" class="form-control">
                            <option value="" disabled selected>-- Select Status --</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                        @error('status') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>


                <div class="text-end">
                    <button class="btn btn-success">✅ Save</button>
                </div>
            </form>
        </div>
    </div>
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
</script>
@endpush