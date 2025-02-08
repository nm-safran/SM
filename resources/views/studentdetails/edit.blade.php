@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Student Detail</h1>
        <form action="{{ route('studentdetails.update', $studentDetail->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="student_code">Student Code</label>
                <input type="text" name="student_code" class="form-control" value="{{ $studentDetail->student_code }}"
                    required>
            </div>
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" class="form-control" value="{{ $studentDetail->first_name }}"
                    required>
            </div>
            <div class="form-group">
                <label for="middle_name">Middle Name</label>
                <input type="text" name="middle_name" class="form-control" value="{{ $studentDetail->middle_name }}">
            </div>
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" class="form-control" value="{{ $studentDetail->last_name }}"
                    required>
            </div>
            <div class="form-group">
                <label for="profile_image">Profile Image</label>
                <input type="file" name="profile_image" class="form-control">
                @if ($studentDetail->profile_image)
                    <img src="{{ $studentDetail->profile_image }}" alt="Profile Image" width="100">
                @endif
            </div>
            <div class="form-group">
                <label for="birth_date">Birth Date</label>
                <input type="date" name="birth_date" class="form-control" value="{{ $studentDetail->birth_date }}"
                    required>
            </div>
            <div class="form-group">
                <label for="age">Age</label>
                <input type="number" name="age" class="form-control" value="{{ $studentDetail->age }}" required>
            </div>
            <div class="form-group">
                <label for="address_one">Address</label>
                <input type="text" name="address_one" class="form-control" value="{{ $studentDetail->address_one }}"
                    required>
            </div>
            <div class="form-group">
                <label for="city">City</label>
                <input type="text" name="city" class="form-control" value="{{ $studentDetail->city }}" required>
            </div>
            <div class="form-group">
                <label for="district">District</label>
                <input type="text" name="district" class="form-control" value="{{ $studentDetail->district }}" required>
            </div>
            <div class="form-group">
                <label for="contact_no">Contact No</label>
                <input type="text" name="contact_no" class="form-control" value="{{ $studentDetail->contact_no }}"
                    required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
