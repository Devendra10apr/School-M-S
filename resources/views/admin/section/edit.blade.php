@extends('layouts.master')

@section('title', 'Create Class')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Update Section</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="">All Section</a></li>
        <li class="breadcrumb-item active">Create Section</li>
    </ol>

    <div class="card mb-4">
        <div class="card-body">
            <form action="{{route('sections.update',$section->id)}}" method="POST">
                @csrf
                @method('put')
                <div class="mb-3">
                    <label for="name" class="form-label">Class Name</label>
                    <select name="classroom_id" id="classroom_id" class="form-control">
                        <option value="" disabled>-Select-</option>
                        @foreach ($classroom as $class )
                            <option value="{{$class->id}}" {{$class->id == $section->classroom_id ?'selected' :''}}>{{$class->name}}</option>
                        @endforeach
                    </select>
                    @error('classroom_id')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Section Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                           id="name" name="name" value="{{$section->name}}" placeholder="Enter class name">
                    @error('name')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Update Sections</button>
            </form>
        </div>
    </div>
</div>
@endsection
