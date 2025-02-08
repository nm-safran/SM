@extends('layouts.app')

@section('content')
    <div class="container-fluid vh-100 d-flex flex-column justify-content-center align-items-center overflow-hidden">
        <div class="row justify-content-center w-100">
            <div class="col-md-12">
                <div class="card shadow-lg">
                    <div class="card-header bg-gradient-primary text-white text-center py-4">
                        <h2 class="display-6">{{ __('Dashboard') }}</h2>
                        <p class="lead">Welcome to the Student Management System</p>
                    </div>
                    <div class="card-body p-5">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="text-center mb-5">
                            <h4 class="text-muted">{{ __('You are logged in!') }}</h4>
                        </div>

                        <div class="d-flex justify-content-center mt-4">
                            @canany(['create-role', 'edit-role', 'delete-role'])
                                <a class="btn btn-primary mx-2 btn-hover-scale" href="{{ route('roles.index') }}">
                                    <i class="bi bi-person-fill-gear me-2"></i> Manage Roles
                                </a>
                            @endcanany
                            @canany(['create-user', 'edit-user', 'delete-user'])
                                <a class="btn btn-success mx-2 btn-hover-scale" href="{{ route('users.index') }}">
                                    <i class="bi bi-people me-2"></i> Manage Users
                                </a>
                            @endcanany
                            @canany(['create-studentdetail', 'edit-studentdetail', 'delete-studentdetail'])
                                <a class="btn btn-warning mx-2 btn-hover-scale" href="{{ route('studentdetails.index') }}">
                                    <i class="bi bi-bag me-2"></i> Manage Student Details
                                </a>
                            @endcanany
                            @can(['view-studentdetail'])
                                <a class="btn btn-info mx-2 btn-hover-scale" href="{{ route('studentdetails.index') }}">
                                    <i class="bi bi-bag me-2"></i> View Student Details
                                </a>
                            @endcan
                        </div>

                        <div class="row mt-5">
                            <div class="col-md-4">
                                <div class="card text-white bg-gradient-info mb-3 card-hover-scale">
                                    <div class="card-header">Roles</div>
                                    <div class="card-body">
                                        <h5 class="card-title">Manage Roles</h5>
                                        <p class="card-text">Create, edit, and delete roles.</p>
                                        <a href="{{ route('roles.index') }}" class="btn btn-light">Go to Roles</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card text-white bg-gradient-success mb-3 card-hover-scale">
                                    <div class="card-header">Users</div>
                                    <div class="card-body">
                                        <h5 class="card-title">Manage Users</h5>
                                        <p class="card-text">Create, edit, and delete users.</p>
                                        <a href="{{ route('users.index') }}" class="btn btn-light">Go to Users</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card text-white bg-gradient-warning mb-3 card-hover-scale">
                                    <div class="card-header">Student Details</div>
                                    <div class="card-body">
                                        <h5 class="card-title">Manage Student Details</h5>
                                        <p class="card-text">Create, edit, and delete student details.</p>
                                        <a href="{{ route('studentdetails.index') }}" class="btn btn-light">Go to Student
                                            Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .container-fluid {
            padding: 0;
            overflow: hidden;
        }

        .bg-gradient-primary {
            background: linear-gradient(45deg, #4e73df, #224abe);
        }

        .bg-gradient-info {
            background: linear-gradient(45deg, #36b9cc, #258391);
        }

        .bg-gradient-success {
            background: linear-gradient(45deg, #1cc88a, #13855c);
        }

        .bg-gradient-warning {
            background: linear-gradient(45deg, #f6c23e, #dda20a);
        }

        .card-hover-scale {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-hover-scale:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .btn-hover-scale {
            transition: transform 0.3s ease;
        }

        .btn-hover-scale:hover {
            transform: scale(1.1);
        }

        .card-header {
            font-size: 1.25rem;
            font-weight: bold;
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .card-text {
            font-size: 1rem;
            color: rgba(255, 255, 255, 0.8);
        }

        .btn-light {
            background-color: rgba(255, 255, 255, 0.9);
            color: #333;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-light:hover {
            background-color: rgba(255, 255, 255, 1);
        }

        .display-4 {
            font-weight: bold;
            letter-spacing: -1px;
        }

        .lead {
            font-size: 1.25rem;
            color: rgba(255, 255, 255, 0.8);
        }
    </style>
@endsection
