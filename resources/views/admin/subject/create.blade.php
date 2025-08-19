@extends('layouts.master')

@section('title', 'Subject')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Create New Subject</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="">All Subjects</a></li>
        <li class="breadcrumb-item active">Create Subject</li>
    </ol>

    <div class="card mb-4">
        <div class="card-body">
           
            <form action="{{route('subject.store')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="classroom_id" class="form-label">Subject Name</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}"  placeholder="Enter Subject name">

                    @error('name')
                        <div class="text-danger mt-1">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="code" class="form-label">Subject Code</label>
                    <input type="text" class="form-control @error('code') is-invalid @enderror"
                           id="code" name="code" placeholder="Enter Subject Code">
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
