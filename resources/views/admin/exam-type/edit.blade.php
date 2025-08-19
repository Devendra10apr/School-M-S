@extends('layouts.master')

@section('title', 'Edit Exam Type')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <h1 class="text-primary fw-bold mb-0">✏️ Edit Exam Type</h1>
    </div>

    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('exam-types.index') }}">Exam Types</a></li>
        <li class="breadcrumb-item active">Edit</li>
    </ol>

    <div class="card shadow-sm rounded">
        <div class="card-body py-4">
            @if ($errors->any())
                @foreach ($errors->all() as $msg)
                    <div class="text-danger">{{ $msg }}</div>
                @endforeach
            @endif

            <form action="{{ route('exam-types.update', $examType->id) }}" method="POST">
                @csrf
                @method('PUT')

                <h4 class="text-secondary border-bottom pb-2 mb-4">📝 Edit Exam Type Information</h4>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Exam Type Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" value="{{ old('name', $examType->name) }}"
                            class="form-control @error('name') is-invalid @enderror">
                        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control">
                            <option value="active" {{ $examType->status == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ $examType->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" rows="3" class="form-control">{{ old('description', $examType->description) }}</textarea>
                    </div>
                </div>

                <div class="text-end">
                    <button class="btn btn-primary px-4 mt-3">💾 Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
