@extends('layouts.master')

@section('title', 'Fee type')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Create Fee Type</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="">Fee Type Name</a></li>
        <li class="breadcrumb-item active">Create Fee Type</li>
    </ol>

    <div class="card mb-4">
        <div class="card-body">

            <form action="{{route('fee_type.update',$feeType->id)}}" method="POST">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-md-6 mb-3 ">
                        <label for="fee_type_id" class="form-label">Fee Category Name</label>
                        <select name="fee_type_id" id="fee_type_id" class="form-control">
                            <option value="" disabled selected>--Selected--</option>
                            @foreach ($categories as $data )
                            <option value="{{$data->id}}" {{$data->id==$feeType->fee_type_id?'selected':''}}>{{$data->name}}</option>
                            @endforeach
                        </select>
                        @error('fee_type_id')
                        <div class="text-danger mt-1">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Fee Type</label>
                        <input type="text" name="name" id="name"
                            class="form-control @error('name') is-invalid @enderror" value="{{old('name',$feeType->name)}}">

                        @error('name')
                        <div class="text-danger mt-1">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="amount" class="form-label">Fee Amount</label>
                        <input type="number" name="amount" id="amount"
                            class="form-control @error('name') is-invalid @enderror" value="{{old('amount',$feeType->amount)}}">

                        @error('amount')
                        <div class="text-danger mt-1">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="due_date" class="form-label">Fee Due Date</label>
                        <input type="date" name="due_date" id="due_date"
                            class="form-control @error('name') is-invalid @enderror" value="{{old('due_date',$feeType->due_date)}}">

                        @error('due_date')
                        <div class="text-danger mt-1">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="late_fee" class="form-label">Late Fee</label>
                        <input type="number" name="late_fee" id="late_fee"
                            class="form-control @error('name') is-invalid @enderror" value="{{old('late_fee',$feeType->late_fee)}}">

                        @error('late_fee')
                        <div class="text-danger mt-1">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="" class="form-control">
                            <option value="" disabled selected>--Select--</option>
                            <option value="active" {{$feeType->status == 'active'?'selected':''}}>Active</option>
                            <option value="inactive" {{$feeType->status == 'inactive'?'selected':''}}>Inactive</option>
                        </select>
                        @error('status')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary text-end">Update Fee Type</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection