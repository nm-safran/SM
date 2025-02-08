@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="title-h3 fw-bold">Edit Student Detail</h3>
                </div>
                <div>
                    <a class="btn" href="{{ route('studentdetails.index') }}"
                        style="background-color: #151515; color: #ffffff;">
                        <i class="fas fa-arrow-left me-2"></i> Back
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('studentdetails.update', $studentDetail->id) }}" method="POST"
                enctype="multipart/form-data" id="studentForm">
                @csrf
                @method('PUT')
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="student_code" class="form-label">Student Code <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="student_code" id="student_code"
                                class="form-control @error('student_code') is-invalid @enderror"
                                value="{{ $studentDetail->student_code }}" required>
                            @error('student_code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                            <input type="text" name="first_name" id="first_name"
                                class="form-control @error('first_name') is-invalid @enderror"
                                value="{{ $studentDetail->first_name }}" required>
                            @error('first_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="middle_name" class="form-label">Middle Name</label>
                            <input type="text" name="middle_name" id="middle_name"
                                class="form-control @error('middle_name') is-invalid @enderror"
                                value="{{ $studentDetail->middle_name }}">
                            @error('middle_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
                            <input type="text" name="last_name" id="last_name"
                                class="form-control @error('last_name') is-invalid @enderror"
                                value="{{ $studentDetail->last_name }}" required>
                            @error('last_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="birth_date" class="form-label">Birth Date <span class="text-danger">*</span></label>
                            <input type="date" name="birth_date" id="birth_date"
                                class="form-control @error('birth_date') is-invalid @enderror"
                                value="{{ $studentDetail->birth_date }}" required>
                            @error('birth_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="contact_no" class="form-label">Contact No <span class="text-danger">*</span></label>
                            <input type="text" name="contact_no" id="contact_no"
                                class="form-control @error('contact_no') is-invalid @enderror"
                                value="{{ $studentDetail->contact_no }}" required>
                            @error('contact_no')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="profile_image" class="form-label">Profile Image</label>
                            <input type="file" name="profile_image" id="profile_image"
                                class="form-control @error('profile_image') is-invalid @enderror" accept="image/*">
                            @if ($studentDetail->profile_image)
                                <img src="{{ $studentDetail->profile_image }}" alt="Profile Image" width="100">
                            @endif
                            @error('profile_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="form-group mb-3">
                            <label for="address_one" class="form-label">Address <span class="text-danger">*</span></label>
                            <input type="text" name="address_one" id="address_one"
                                class="form-control @error('address_one') is-invalid @enderror"
                                value="{{ $studentDetail->address_one }}" required>
                            @error('address_one')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="city" class="form-label">City <span class="text-danger">*</span></label>
                            <input type="text" name="city" id="city"
                                class="form-control @error('city') is-invalid @enderror"
                                value="{{ $studentDetail->city }}" required>
                            @error('city')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="district" class="form-label">District <span class="text-danger">*</span></label>
                            <select name="district" id="district"
                                class="form-select @error('district') is-invalid @enderror" required>
                                <option value="">Select District</option>
                                <option value="Ampara" {{ $studentDetail->district == 'Ampara' ? 'selected' : '' }}>Ampara
                                </option>
                                <option value="Anuradhapura"
                                    {{ $studentDetail->district == 'Anuradhapura' ? 'selected' : '' }}>
                                    Anuradhapura</option>
                                <option value="Badulla" {{ $studentDetail->district == 'Badulla' ? 'selected' : '' }}>
                                    Badulla
                                </option>
                                <option value="Batticaloa"
                                    {{ $studentDetail->district == 'Batticaloa' ? 'selected' : '' }}>
                                    Batticaloa</option>
                                <option value="Colombo" {{ $studentDetail->district == 'Colombo' ? 'selected' : '' }}>
                                    Colombo
                                </option>
                                <option value="Galle" {{ $studentDetail->district == 'Galle' ? 'selected' : '' }}>Galle
                                </option>
                                <option value="Gampaha" {{ $studentDetail->district == 'Gampaha' ? 'selected' : '' }}>
                                    Gampaha
                                </option>
                                <option value="Hambantota"
                                    {{ $studentDetail->district == 'Hambantota' ? 'selected' : '' }}>
                                    Hambantota</option>
                                <option value="Jaffna" {{ $studentDetail->district == 'Jaffna' ? 'selected' : '' }}>Jaffna
                                </option>
                                <option value="Kalutara" {{ $studentDetail->district == 'Kalutara' ? 'selected' : '' }}>
                                    Kalutara
                                </option>
                                <option value="Kandy" {{ $studentDetail->district == 'Kandy' ? 'selected' : '' }}>Kandy
                                </option>
                                <option value="Kegalle" {{ $studentDetail->district == 'Kegalle' ? 'selected' : '' }}>
                                    Kegalle
                                </option>
                                <option value="Kilinochchi"
                                    {{ $studentDetail->district == 'Kilinochchi' ? 'selected' : '' }}>
                                    Kilinochchi</option>
                                <option value="Kurunegala"
                                    {{ $studentDetail->district == 'Kurunegala' ? 'selected' : '' }}>
                                    Kurunegala</option>
                                <option value="Mannar" {{ $studentDetail->district == 'Mannar' ? 'selected' : '' }}>Mannar
                                </option>
                                <option value="Matale" {{ $studentDetail->district == 'Matale' ? 'selected' : '' }}>Matale
                                </option>
                                <option value="Matara" {{ $studentDetail->district == 'Matara' ? 'selected' : '' }}>Matara
                                </option>
                                <option value="Monaragala"
                                    {{ $studentDetail->district == 'Monaragala' ? 'selected' : '' }}>
                                    Monaragala</option>
                                <option value="Mullaitivu"
                                    {{ $studentDetail->district == 'Mullaitivu' ? 'selected' : '' }}>
                                    Mullaitivu</option>
                                <option value="Nuwara Eliya"
                                    {{ $studentDetail->district == 'Nuwara Eliya' ? 'selected' : '' }}>
                                    Nuwara Eliya</option>
                                <option value="Polonnaruwa"
                                    {{ $studentDetail->district == 'Polonnaruwa' ? 'selected' : '' }}>
                                    Polonnaruwa</option>
                                <option value="Puttalam" {{ $studentDetail->district == 'Puttalam' ? 'selected' : '' }}>
                                    Puttalam
                                </option>
                                <option value="Ratnapura" {{ $studentDetail->district == 'Ratnapura' ? 'selected' : '' }}>
                                    Ratnapura
                                </option>
                                <option value="Trincomalee"
                                    {{ $studentDetail->district == 'Trincomalee' ? 'selected' : '' }}>
                                    Trincomalee</option>
                                <option value="Vavuniya" {{ $studentDetail->district == 'Vavuniya' ? 'selected' : '' }}>
                                    Vavuniya
                                </option>
                            </select>
                            @error('district')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="d-flex justify-content-end gap-2">
                            <button type="reset" class="btn btn-secondary">
                                <i class="fas fa-undo me-2"></i> Reset
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i> Update Student
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .card {
            border-radius: 8px;
            border: none;
        }

        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .form-control {
            border-radius: 4px;
            padding: 0.5rem 1rem;
        }

        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
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

        .form-select {
            border-radius: 4px;
            padding: 0.5rem 2.25rem 0.5rem 1rem;
            background-position: right 0.75rem center;
            background-size: 16px 12px;
        }

        .form-select:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }
    </style>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // Form submission
            $('#studentForm').on('submit', function(e) {
                e.preventDefault();
                var form = $(this);

                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you want to update this student?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#151515',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, update it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Show loading state
                        Swal.fire({
                            title: 'Updating...',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });

                        // Submit the form
                        form[0].submit();
                    }
                });
            });

            // Show success message if exists
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: "{{ session('success') }}",
                    confirmButtonColor: '#151515'
                });
            @endif

            // Show error message if exists
            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: "{{ session('error') }}",
                    confirmButtonColor: '#151515'
                });
            @endif
        });
    </script>
@endsection
