@extends('layouts.master')

@section('title', 'Fee Category Name')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Create New Subject</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="">Fee Category Name</a></li>
        <li class="breadcrumb-item active">Create Fee Category</li>
    </ol>

    <div class="card mb-4">
        <div class="card-body">
           
            <form action="{{route('fee_category.update',$feeCategory->id)}}" method="POST">
                @csrf
                @method('put')
                <div class="mb-3">
                    <label for="name" class="form-label">Fee Category Name</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name',$feeCategory->name)}}">

                    @error('name')
                        <div class="text-danger mt-1">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="" cols="2" rows="2" class="form-control">{{ old('description', $feeCategory->description) }}</textarea>
                    </textarea>
                    @error('description')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="" class="form-control">
                        <option value="" disabled selected>--Select--</option>
                        <option value="active" {{$feeCategory->status == 'active'?'selected':''}} >Active</option>
                        <option value="inactive"{{$feeCategory->status == 'inactive'?'selected':''}} >Inactive</option>
                    </select>
                    @error('status')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-primary text-end">Update Fee Category</button>
                </div>
                
            </form>
        </div>
    </div>
</div>
@endsection
