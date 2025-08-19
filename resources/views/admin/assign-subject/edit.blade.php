@extends('layouts.master')

@section('title', 'Assign Subject')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Assign Subject</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="">All Assign Subject</a></li>
        <li class="breadcrumb-item active">Assign Subject</li>
    </ol>

    <div class="card mb-4">
        <div class="card-body">

            <form action="{{route('assignedSubject.update', $assignedSubject->id)}}" method="POST">
                @csrf
                @method('put')
                <div class="mb-3">
                    <label for="classroom_id" class="form-label">Class Name</label>
                    <select name="classroom_id" id="classroom_id" class="form-control">
                        <option value="" disabled>-Select-</option>
                        @foreach ($classes as $class )
                        <option value="{{ $class->id }}" {{ $class->id == $assignedSubject->classroom_id ? 'selected' :
                            '' }}>
                            {{ $class->name }}
                        </option>

                        @endforeach
                    </select>

                    @error('classroom_id')
                    <div class="text-danger mt-1">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="section_id" class="form-label">Section</label>
                    <select name="section_id" id="section_id" class="form-control">
                        <option value="" selected disabled>-Select-</option>
                        @foreach ($sections as $section )
                        <option value="{{ $section->id }}" {{ $section->id == $assignedSubject->section_id ? 'selected'
                            : '' }}>
                            {{ $section->name }}
                        </option>

                        @endforeach
                    </select>

                    @error('section_id')
                    <div class="text-danger mt-1">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="subject_id" class="form-label">Subject Name</label>
                    <select name="subject_id" id="subject_id" class="form-control">
                        <option value="" selected disabled>-Select-</option>
                        @foreach ($subjects as $subject )
                        <option value="{{ $subject->id }}" {{ $subject->id == $assignedSubject->subject_id ? 'selected'
                            : '' }}>
                            {{ $subject->name }}
                        </option>

                        @endforeach
                    </select>

                    @error('subject_id')
                    <div class="text-danger mt-1">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="teacher_id" class="form-label">Teacher Name</label>
                    <select name="teacher_id" id="teacher_id" class="form-control">
                        <option value="" selected disabled>-Select-</option>
                        @foreach ($teachers as $teacher)
                        <option value="{{ $teacher->id }}" {{ $teacher->id == $assignedSubject->teacher_id ? 'selected'
                            : '' }}>
                            {{ $teacher->name }}
                        </option>

                        @endforeach
                    </select>

                    @error('teacher_id')
                    <div class="text-danger mt-1">{{$message}}</div>
                    @enderror
                </div>


                <button type="submit" class="btn btn-primary">Update Assign Subject</button>
            </form>
        </div>
    </div>
</div>
@endsection