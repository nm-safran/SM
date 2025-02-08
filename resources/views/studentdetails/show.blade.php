@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="title-h3 fw-bold">Student Information</h3>
                </div>
                <div class="d-flex gap-2">

                    <a class="btn" href="{{ route('studentdetails.index') }}"
                        style="background-color: #151515; color: #ffffff;">
                        <i class="fas fa-arrow-left me-2"></i> Back
                    </a>

                    @can('edit-studentdetail')
                        <a class="btn btn-primary" href="{{ route('studentdetails.edit', $studentDetail) }}">
                            <i class="fas fa-edit me-2"></i> Edit
                        </a>
                    @endcan
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3 text-center mb-4">
                    @if ($studentDetail->profile_image)
                        <img src="{{ asset($studentDetail->profile_image) }}" alt="Profile Image"
                            class="img-profile rounded-circle mb-3" style="width: 200px; height: 200px; object-fit: cover;">
                    @else
                        <div class="no-image-placeholder rounded-circle mb-3">
                            <i class="fas fa-user"></i>
                        </div>
                    @endif
                    <h4 class="mb-1">{{ $studentDetail->student_code }}</h4>
                    <p class="text-muted">Student Code</p>
                </div>

                <div class="col-md-9">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <div class="detail-item">
                                <label class="fw-bold">Full Name</label>
                                <p class="detail-value">{{ $studentDetail->full_name }}</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="detail-item">
                                <label class="fw-bold">First Name</label>
                                <p class="detail-value">{{ $studentDetail->first_name }}</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="detail-item">
                                <label class="fw-bold">Middle Name</label>
                                <p class="detail-value">{{ $studentDetail->middle_name ?: 'N/A' }}</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="detail-item">
                                <label class="fw-bold">Last Name</label>
                                <p class="detail-value">{{ $studentDetail->last_name }}</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="detail-item">
                                <label class="fw-bold">Birth Date</label>
                                <p class="detail-value">{{ $studentDetail->formatted_birth_date }}</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="detail-item">
                                <label class="fw-bold">Age</label>
                                <p class="detail-value">{{ $studentDetail->age }} years</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="detail-item">
                                <label class="fw-bold">Contact Number</label>
                                <p class="detail-value">{{ $studentDetail->formatted_contact }}</p>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="detail-item">
                                <label class="fw-bold">Address</label>
                                <p class="detail-value">{{ $studentDetail->address }}</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="detail-item">
                                <label class="fw-bold">City</label>
                                <p class="detail-value">{{ $studentDetail->city }}</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="detail-item">
                                <label class="fw-bold">District</label>
                                <p class="detail-value">{{ $studentDetail->district }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .card {
            border-radius: 8px;
            border: none;
        }

        .img-profile {
            border: 4px solid #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .img-profile:hover {
            transform: scale(1.05);
        }

        .no-image-placeholder {
            width: 200px;
            height: 200px;
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
        }

        .no-image-placeholder i {
            font-size: 4rem;
            color: #dee2e6;
        }

        .detail-item {
            margin-bottom: 1.5rem;
            background-color: #f8f9fa;
            padding: 1rem;
            border-radius: 8px;
        }

        .detail-item label {
            display: block;
            color: #6c757d;
            font-size: 0.875rem;
            margin-bottom: 0.25rem;
        }

        .detail-item .detail-value {
            font-size: 1rem;
            color: #212529;
            margin-bottom: 0;
        }

        .btn-custom {
            background-color: #151515;
            color: #fff;
            transition: all 0.3s;
        }

        .btn-custom:hover {
            background-color: #4d4d4d;
            color: #fff;
            transform: translateY(-1px);
        }

        .title-h3 {
            color: #151515;
            margin-bottom: 0;
        }
    </style>
@endsection
