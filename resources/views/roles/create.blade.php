@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-3">
                <div
                    class="card-header bg-gradient bg-primary text-white d-flex justify-content-between align-items-center py-3">
                    <h5 class="mb-0 ms-2 fw-semibold">
                        <i class="bi bi-shield-plus me-2"></i>Add New Role
                    </h5>
                    <a href="{{ route('roles.index') }}" class="btn btn-light btn-sm rounded-pill px-3 shadow-sm hover-scale">
                        <i class="bi bi-arrow-left me-1"></i>Back
                    </a>
                </div>
                <div class="card-body p-4">
                    <form id="create-role-form" action="{{ route('roles.store') }}" method="post">
                        @csrf

                        <div class="mb-4 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end fw-medium">Role Name</label>
                            <div class="col-md-6">
                                <input type="text"
                                    class="form-control form-control-lg @error('name') is-invalid @enderror" id="name"
                                    name="name" value="{{ old('name') }}" placeholder="Enter role name">
                                @error('name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <label for="permissions"
                                class="col-md-4 col-form-label text-md-end fw-medium">Permissions</label>
                            <div class="col-md-6">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-0">
                                        <select class="form-select @error('permissions') is-invalid @enderror" multiple
                                            aria-label="Permissions" id="permissions" name="permissions[]"
                                            style="height: 210px; border: none;">
                                            @forelse ($permissions as $permission)
                                                <option value="{{ $permission->id }}"
                                                    {{ in_array($permission->id, old('permissions') ?? []) ? 'selected' : '' }}>
                                                    {{ $permission->name }}
                                                </option>
                                            @empty
                                                <option disabled>No permissions available</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                @error('permissions')
                                    <span class="invalid-feedback d-block mt-2">{{ $message }}</span>
                                @enderror
                                <div class="form-text mt-2">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Hold Ctrl/Cmd to select multiple permissions
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-lg rounded-pill px-4 hover-scale">
                                    <i class="bi bi-shield-plus me-2"></i>Create Role
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .hover-scale {
            transition: transform 0.2s ease;
        }

        .hover-scale:hover {
            transform: scale(1.05);
        }

        .form-select option {
            padding: 10px;
            margin: 2px 0;
        }

        .form-select option:checked {
            background-color: var(--bs-primary);
            color: white;
        }

        .form-select:focus {
            border-color: var(--bs-primary);
            box-shadow: 0 0 0 0.25rem rgba(var(--bs-primary-rgb), 0.25);
        }
    </style>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('create-role-form').addEventListener('submit', function(event) {
            event.preventDefault();
            var form = this;
            Swal.fire({
                title: 'Create New Role',
                text: "Are you sure you want to create this role?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#0d6efd',
                cancelButtonColor: '#dc3545',
                confirmButtonText: '<i class="bi bi-shield-plus me-1"></i>Yes, create it!',
                cancelButtonText: '<i class="bi bi-x-circle me-1"></i>Cancel',
                reverseButtons: true,
                buttonsStyling: true,
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-danger'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });

        @if (session('success'))
            Swal.fire({
                title: 'Success!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK',
                confirmButtonColor: '#0d6efd'
            }).then(() => {
                window.location.href = "{{ route('roles.index') }}";
            });
        @endif
    </script>
@endsection
