@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Student Details</h1>
        <a href="{{ route('studentdetails.create') }}" class="btn btn-primary">Add New Student</a>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Student Code</th>
                    <th>Name</th>
                    <th>Profile Image</th>
                    <th>Birth Date</th>
                    <th>Age</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>District</th>
                    <th>Contact No</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($studentDetails as $studentDetail)
                    <tr>
                        <td>{{ $studentDetail->id }}</td>
                        <td>{{ $studentDetail->student_code }}</td>
                        <td>{{ $studentDetail->first_name }} {{ $studentDetail->middle_name }}
                            {{ $studentDetail->last_name }}</td>
                        <td><img src="{{ $studentDetail->profile_image }}" alt="Profile Image" width="50"></td>
                        <td>{{ $studentDetail->birth_date }}</td>
                        <td>{{ $studentDetail->age }}</td>
                        <td>{{ $studentDetail->address_one }}</td>
                        <td>{{ $studentDetail->city }}</td>
                        <td>{{ $studentDetail->district }}</td>
                        <td>{{ $studentDetail->contact_no }}</td>
                        <td>
                            <a href="{{ route('studentdetails.show', $studentDetail->id) }}" class="btn btn-info">View</a>
                            <a href="{{ route('studentdetails.edit', $studentDetail->id) }}"
                                class="btn btn-warning">Edit</a>
                            <form action="{{ route('studentdetails.destroy', $studentDetail->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
