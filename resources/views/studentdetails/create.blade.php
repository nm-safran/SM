@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="title-h3 fw-bold">Add New Student</h3>
                </div>
                <div>
                    <a class="btn btn-custom" href="{{ route('studentdetails.index') }}">
                        <i class="fas fa-arrow-left me-2"></i> Back
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('studentdetails.store') }}" method="POST" enctype="multipart/form-data" id="studentForm">
                @csrf
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="student_code" class="form-label">Student Code <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="student_code" id="student_code"
                                class="form-control @error('student_code') is-invalid @enderror"
                                value="{{ old('student_code') }}" required>
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
                                value="{{ old('first_name') }}" required>
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
                                value="{{ old('middle_name') }}">
                            @error('middle_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
                            <input type="text" name="last_name" id="last_name"
                                class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}"
                                required>
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
                                value="{{ old('birth_date') }}" required>
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
                                value="{{ old('contact_no') }}" required>
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
                                value="{{ old('address_one') }}" required>
                            @error('address_one')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="city" class="form-label">City <span class="text-danger">*</span></label>
                            <input type="text" name="city" id="city"
                                class="form-control @error('city') is-invalid @enderror" value="{{ old('city') }}"
                                required>
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
                                <option value="Ampara" {{ old('district') == 'Ampara' ? 'selected' : '' }}>Ampara</option>
                                <option value="Anuradhapura" {{ old('district') == 'Anuradhapura' ? 'selected' : '' }}>
                                    Anuradhapura</option>
                                <option value="Badulla" {{ old('district') == 'Badulla' ? 'selected' : '' }}>Badulla
                                </option>
                                <option value="Batticaloa" {{ old('district') == 'Batticaloa' ? 'selected' : '' }}>
                                    Batticaloa</option>
                                <option value="Colombo" {{ old('district') == 'Colombo' ? 'selected' : '' }}>Colombo
                                </option>
                                <option value="Galle" {{ old('district') == 'Galle' ? 'selected' : '' }}>Galle</option>
                                <option value="Gampaha" {{ old('district') == 'Gampaha' ? 'selected' : '' }}>Gampaha
                                </option>
                                <option value="Hambantota" {{ old('district') == 'Hambantota' ? 'selected' : '' }}>
                                    Hambantota</option>
                                <option value="Jaffna" {{ old('district') == 'Jaffna' ? 'selected' : '' }}>Jaffna</option>
                                <option value="Kalutara" {{ old('district') == 'Kalutara' ? 'selected' : '' }}>Kalutara
                                </option>
                                <option value="Kandy" {{ old('district') == 'Kandy' ? 'selected' : '' }}>Kandy</option>
                                <option value="Kegalle" {{ old('district') == 'Kegalle' ? 'selected' : '' }}>Kegalle
                                </option>
                                <option value="Kilinochchi" {{ old('district') == 'Kilinochchi' ? 'selected' : '' }}>
                                    Kilinochchi</option>
                                <option value="Kurunegala" {{ old('district') == 'Kurunegala' ? 'selected' : '' }}>
                                    Kurunegala</option>
                                <option value="Mannar" {{ old('district') == 'Mannar' ? 'selected' : '' }}>Mannar</option>
                                <option value="Matale" {{ old('district') == 'Matale' ? 'selected' : '' }}>Matale</option>
                                <option value="Matara" {{ old('district') == 'Matara' ? 'selected' : '' }}>Matara</option>
                                <option value="Monaragala" {{ old('district') == 'Monaragala' ? 'selected' : '' }}>
                                    Monaragala</option>
                                <option value="Mullaitivu" {{ old('district') == 'Mullaitivu' ? 'selected' : '' }}>
                                    Mullaitivu</option>
                                <option value="Nuwara Eliya" {{ old('district') == 'Nuwara Eliya' ? 'selected' : '' }}>
                                    Nuwara Eliya</option>
                                <option value="Polonnaruwa" {{ old('district') == 'Polonnaruwa' ? 'selected' : '' }}>
                                    Polonnaruwa</option>
                                <option value="Puttalam" {{ old('district') == 'Puttalam' ? 'selected' : '' }}>Puttalam
                                </option>
                                <option value="Ratnapura" {{ old('district') == 'Ratnapura' ? 'selected' : '' }}>Ratnapura
                                </option>
                                <option value="Trincomalee" {{ old('district') == 'Trincomalee' ? 'selected' : '' }}>
                                    Trincomalee</option>
                                <option value="Vavuniya" {{ old('district') == 'Vavuniya' ? 'selected' : '' }}>Vavuniya
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
                                <i class="fas fa-save me-2"></i> Save Student
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
        document.getElementById('birth_date').addEventListener('change', function() {
            const birthDate = new Date(this.value);
            const today = new Date();
            let age = today.getFullYear() - birthDate.getFullYear();
            const monthDiff = today.getMonth() - birthDate.getMonth();

            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
        });

        // Form validation before submit
        document.getElementById('studentForm').addEventListener('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                text: 'Are you sure you want to save this student?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, Save it!',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#0d6efd',
                cancelButtonColor: '#6c757d',
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    </script>
@endsection
