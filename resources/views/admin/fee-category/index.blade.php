@extends('layouts.master')

@section('title', 'Subject List')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Fee categories</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard / categories</li>
    </ol>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card mb-4 shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-table me-1"></i> All Fee Categories
            </div>
            <a href="{{ route('fee_category.create') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus"></i> Add Fee Category
            </a>
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th>category Name</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th style="width: 150px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($fee_categories as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->description }}</td>
                        <td>{{ $data->status }}</td>
                        <td>
                            <a href="{{route('fee_category.edit',$data->id)}}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>

                            <form action="{{route('fee_category.destroy',$data->id)}}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
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
                        <th>#</th>
                        <th>Class Name</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
