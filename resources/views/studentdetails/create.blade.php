@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add New Student Detail</h1>
        <form action="{{ route('studentdetails.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="student_code">Student Code</label>
                <input type="text" name="student_code" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="middle_name">Middle Name</label>
                <input type="text" name="middle_name" class="form-control">
            </div>
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="profile_image">Profile Image</label>
                <input type="file" name="profile_image" class="form-control">
            </div>
            <div class="form-group">
                <label for="birth_date">Birth Date</label>
                <input type="date" name="birth_date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="age">Age</label>
                <input type="number" name="age" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="address_one">Address</label>
                <input type="text" name="address_one" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="city">City</label>
                <input type="text" name="city" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="district">District</label>
                <input type="text" name="district" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="contact_no">Contact No</label>
                <input type="text" name="contact_no" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
