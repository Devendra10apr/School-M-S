@extends('layouts.master')

@section('title', 'Fee types')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Fee categories</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard / feeType</li>
    </ol>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card mb-4 shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-table me-1"></i> All Fee Types
            </div>
            <a href="{{ route('fee_type.create') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus"></i> Add Fee Types
            </a>
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th>Category Name</th>
                        <th>FeeType Name</th>
                        <th>Fee amount</th>
                        <th>Due Date</th>
                        <th>Late Fee</th>
                        <th>Status</th>
                        <th style="width: 150px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ( $fee_types as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->feeCategory->name }}</td>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->amount }}</td>
                        <td>{{ $data->due_date }}</td>
                        <td>{{ $data->late_fee }}</td>
                        <td>{{ $data->status }}</td>
                        <td>
                            <a href="{{route('fee_type.edit',$data->id)}}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>

                            <form action="{{route('fee_type.destroy', $data->id )}}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot class="table-light">
                    <tr>
                       <th style="width: 50px;">#</th>
                        <th>Category Name</th>
                        <th>FeeType Name</th>
                        <th>Fee amount</th>
                        <th>Due Date</th>
                        <th>Late Fee</th>
                        <th>Status</th>
                        <th style="width: 150px;">Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
