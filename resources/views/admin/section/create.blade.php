@extends('layouts.master')

@section('title', 'Section Class')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Create New Section</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="">All Sections</a></li>
        <li class="breadcrumb-item active">Create Section</li>
    </ol>

    <div class="card mb-4">
        <div class="card-body">
            <form action="{{route('sections.store')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="classroom_id" class="form-label">Class</label>
                    <select name="classroom_id" id="classroom_id" class="form-control">
                       <option value="" disabled>-Selected-</option>
                       @foreach ($classes as $class )
                           <option value="{{$class->id}}">{{$class->name}}</option>
                       @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Section</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                           id="name" name="name" placeholder="Enter section name">
                    @error('name')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-primary">Create Section</button>
            </form>
        </div>
    </div>
</div>
@endsection
