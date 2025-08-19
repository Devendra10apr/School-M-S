@extends('layouts.master')

@section('title', 'Create Class')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Create New Class</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="">All Classes</a></li>
        <li class="breadcrumb-item active">Create Class</li>
    </ol>

    <div class="card mb-4">
        <div class="card-body">
            <form action="{{route('classroom.store')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Class Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                           id="name" name="name" placeholder="Enter class name">
                    @error('name')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Create Class</button>
            </form>
        </div>
    </div>
</div>
@endsection
