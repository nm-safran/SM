@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Student Detail</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $studentDetail->first_name }} {{ $studentDetail->middle_name }}
                    {{ $studentDetail->last_name }}</h5>
                <p class="card-text">Student Code: {{ $studentDetail->student_code }}</p>
                <p class="card-text">Profile Image: <img src="{{ $studentDetail->profile_image }}" alt="Profile Image"
                        width="100"></p>
                <p class="card-text">Birth Date: {{ $studentDetail->birth_date }}</p>
                <p class="card-text">Age: {{ $studentDetail->age }}</p>
                <p class="card-text">Address: {{ $studentDetail->address_one }}, {{ $studentDetail->city }},
                    {{ $studentDetail->district }}</p>
                <p class="card-text">Contact No: {{ $studentDetail->contact_no }}</p>
                <a href="{{ route('studentdetails.index') }}" class="btn btn-primary">Back to List</a>
            </div>
        </div>
    </div>
@endsection
