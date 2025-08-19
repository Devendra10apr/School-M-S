@extends('layouts.master')

@section('title', 'Update Student Admission')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <h1 class="text-primary fw-bold mb-0">🎓 Update Student Admission</h1>
    </div>

    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('student-profiles.index') }}">All Students</a></li>
        <li class="breadcrumb-item active">Update Student Admission</li>
    </ol>

    <div class="card shadow-sm rounded">
        <div class="card-body py-4">
            @if ($errors->any())
           
                @foreach ($errors->all() as $msg)
                <div class="text-danger">{{ $msg }}</div>
                @endforeach
            
            @endif

            <form action="{{ route('student-profiles.update',$studentProfile->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                {{-- Student Info --}}
                <h4 class="text-secondary border-bottom pb-2 mb-4">🧒 Student Information</h4>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Student Name</label>
                        <input type="text" name="student_name" value="{{old('student_name',$studentProfile->student->name)}}" class="form-control"
                            required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="student_email" value="{{old('student_email',$studentProfile->student->email)}}" class="form-control"
                            required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Mobile</label>
                        <input type="text" name="student_mobile" value="{{old('student_mobile',$studentProfile->student_mobile)}}" class="form-control">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Gender</label>
                        <select name="gender" class="form-control">
                            <option disabled selected>- Select -</option>
                            <option value="male"{{$studentProfile->gender == 'male'?'selected':''}}>Male</option>
                            <option value="female" {{$studentProfile->gender == 'female'?'selected':''}} >Female</option>
                            <option value="other" {{$studentProfile->gender == 'other'?'selected':''}}>Other</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">DOB</label>
                        <input type="date" name="dob" value="{{old('dob',$studentProfile->dob)}}" class="form-control">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Blood Group</label>
                        <input type="text" name="blood_group" value="{{old('blood_group',$studentProfile->blood_group)}}" class="form-control">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Religion</label>
                        <input type="text" name="religion" value="{{old('religion',$studentProfile->religion)}}" class="form-control">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Caste</label>
                        <input type="text" name="caste" value="{{old('caste',$studentProfile->caste)}}" class="form-control">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Aadhar No</label>
                        <input type="text" name="aadhar_no" value="{{old('aadhar_no',$studentProfile->aadhar_no)}}" class="form-control">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">TC No</label>
                        <input type="text" name="tc_no" value="{{old('tc_no',$studentProfile->tc_no)}}" class="form-control">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Photo</label>
                        <input type="file" name="photo" value="{{old('photo')}}" class="form-control">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Address</label>
                        <textarea name="address" class="form-control" rows="2">{{old('address', $studentProfile->address)}}</textarea>
                    </div>

                </div>

                {{-- Class & Section --}}
                <h4 class="text-secondary border-bottom pb-2 mt-5 mb-4">🏫 Class & Section</h4>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Class</label>
                        <select name="classroom_id" value="{{old('classroom_id')}}" class="form-control" required>
                            <option disabled selected>- Select -</option>
                            @foreach($classrooms as $classroom)
                            <option value="{{ $classroom->id }}" {{$classroom->id==$studentProfile->classroom_id?'selected':''}}>{{ $classroom->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Section</label>
                        <select name="section_id" value="{{old('section_id')}}" class="form-control" required>
                            <option disabled selected>- Select -</option>
                            @foreach($sections as $section)
                            <option value="{{ $section->id }}" {{$section->id==$studentProfile->section_id?'selected':''}}>{{ $section->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Parent Info --}}
                <h4 class="text-secondary border-bottom pb-2 mt-5 mb-4">👨‍👩‍👧 Parent Information</h4>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Father's Name</label>
                        <input type="text" name="father_name" value="{{old('father_name',$studentProfile->parentdetails->father_name)}}" class="form-control"
                            required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Mother's Name</label>
                        <input type="text" name="mother_name" value="{{old('mother_name',$studentProfile->parentdetails->mother_name)}}" class="form-control"
                            required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Parent Email</label>
                        <input type="email" name="parent_email" value="{{old('parent_email',$studentProfile->parentdetails->parent_email)}}" class="form-control"
                            required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Parent Mobile</label>
                        <input type="text" name="parent_mobile" value="{{old('parent_mobile',$studentProfile->parentdetails->parent_mobile)}}" class="form-control">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Occupation</label>
                        <input type="text" name="occupation" value="{{old('occupation',$studentProfile->parentdetails->occupation)}}" class="form-control">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Education</label>
                        <input type="text" name="education" value="{{old('education',$studentProfile->parentdetails->education)}}" class="form-control">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Relation</label>
                        <input type="text" name="relation" value="{{old('relation',$studentProfile->parentdetails->relation)}}" class="form-control">
                    </div>
                    <div class="col-md-8 mb-3">
                        <label class="form-label">Parent Address</label>
                        <textarea name="parent_address" rows="1" class="form-control"
                            rows="2">{{old('parent_address',$studentProfile->parentdetails->address)}}</textarea>
                    </div>
                </div>

                <div class="text-end">
                    <button class="btn btn-primary px-4 mt-4">✅ Update Admission Details</button>
                </div>
            </form>

        </div>

    </div>
    <hr class="mb-3">
</div>
@endsection