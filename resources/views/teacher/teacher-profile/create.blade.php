@extends('layouts.master')

@section('title', 'Teacher Register')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <h1 class="text-primary fw-bold mb-0">🎓 Teacher Create</h1>
    </div>

    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('student-profiles.index') }}">All Teacher</a></li>
        <li class="breadcrumb-item active">New Teacher Register</li>
    </ol>

    <div class="card shadow-sm rounded">
        <div class="card-body py-4">
            @if ($errors->any())
           
                @foreach ($errors->all() as $msg)
                <div class="text-danger">{{ $msg }}</div>
                @endforeach
            
            @endif

            <form action="{{route('teachers.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- Student Info --}}
                <h4 class="text-secondary border-bottom pb-2 mb-4">🧑‍🏫 Teacher Information</h4>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Teacher Name</label>
                        <input type="text" name="name" value="{{old('name')}}" class="form-control"
                            required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Teacher Email</label>
                        <input type="email" name="email" value="{{old('email')}}" class="form-control"
                            required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Mobile</label>
                        <input type="text" name="mobile" value="{{old('mobile')}}" class="form-control">
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label class="form-label">DOB</label>
                        <input type="date" name="dob" value="{{old('dob')}}" class="form-control">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Gender</label>
                        <select name="gender"  class="form-control">
                            <option disabled selected>- Select -</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                   
                    
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Aadhar No</label>
                        <input type="text" name="aadhaar_no" value="{{old('aadhaar_no')}}" class="form-control">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Education</label>
                        <input type="text" name="education" value="{{old('education')}}" class="form-control">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Subject</label>
                        <input type="text" name="subject" value="{{old('subject')}}" class="form-control">
                    </div>
                   
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Address</label>
                        <textarea name="address" class="form-control" rows="2">{{old('address')}}</textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Photo</label>
                        <input type="file" name="photo" id="photo" class="form-control">
                    </div>

                </div>
              
                <div class="text-end">
                    <button class="btn btn-primary px-4 mt-4">✅ Submit</button>
                </div>
            </form>

        </div>

    </div>
    <hr class="mb-3">
</div>
@endsection