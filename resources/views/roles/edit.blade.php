@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-3">
                <div
                    class="card-header bg-gradient bg-primary text-white d-flex justify-content-between align-items-center py-3">
                    <h5 class="mb-0 ms-2 fw-semibold">
                        <i class="bi bi-shield-check me-2"></i>Edit Role
                    </h5>
                    <a href="{{ route('roles.index') }}" class="btn btn-light btn-sm rounded-pill px-3 shadow-sm hover-scale">
                        <i class="bi bi-arrow-left me-1"></i>Back
                    </a>
                </div>
                <div class="card-body p-4">
                    @if (auth()->user()->hasRole('Super Admin'))
                        <form id="update-role-form" action="{{ route('roles.update', $role->id) }}" method="post">
                            @csrf
                            @method('PUT')

                            <div class="mb-4 row">
                                <label for="name" class="col-md-4 col-form-label text-md-end fw-medium">Role
                                    Name</label>
                                <div class="col-md-6">
                                    <input type="text"
                                        class="form-control form-control-lg @error('name') is-invalid @enderror"
                                        id="name" name="name" value="{{ $role->name }}"
                                        placeholder="Enter role name">
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
                                        <div class="card-body p-3">
                                            <div class="permission-grid">
                                                @forelse ($permissions as $permission)
                                                    <div class="form-check">
                                                        <input
                                                            class="form-check-input permission-checkbox @error('permissions') is-invalid @enderror"
                                                            type="checkbox" id="permission{{ $permission->id }}"
                                                            name="permissions[]" value="{{ $permission->id }}"
                                                            {{ in_array($permission->id, $rolePermissions ?? []) ? 'checked' : '' }}>
                                                        <label class="form-check-label user-select-none"
                                                            for="permission{{ $permission->id }}">
                                                            {{ $permission->name }}
                                                        </label>
                                                    </div>
                                                @empty
                                                    <div class="text-center py-3">
                                                        <i class="bi bi-exclamation-circle text-muted fs-4"></i>
                                                        <p class="text-muted mb-0">No permissions available</p>
                                                    </div>
                                                @endforelse
                                            </div>
                                        </div>
                                    </div>
                                    @error('permissions')
                                        <span class="invalid-feedback d-block mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary btn-lg rounded-pill px-4 hover-scale">
                                        <i class="bi bi-check2-circle me-2"></i>Update Role
                                    </button>
                                </div>
                            </div>
                        </form>
                    @else
                        <div class="alert alert-danger d-flex align-items-center m-4" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            <div>You do not have permission to edit roles.</div>
                        </div>
                    @endif
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

        .permission-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1rem;
        }

        .permission-checkbox:checked {
            background-color: var(--bs-primary);
            border-color: var(--bs-primary);
        }

        .form-check-label {
            transition: color 0.2s ease;
        }

        .form-check-input:checked~.form-check-label {
            color: var(--bs-primary);
            font-weight: 500;
        }

        .user-select-none {
            user-select: none;
        }
    </style>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('update-role-form')?.addEventListener('submit', function(event) {
            event.preventDefault();
            var form = this;
            Swal.fire({
                title: 'Update Role',
                text: "Are you sure you want to update this role?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#0d6efd',
                cancelButtonColor: '#dc3545',
                confirmButtonText: '<i class="bi bi-check2-circle me-1"></i>Yes, update it!',
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
                confirmButtonColor: '#0d6efd',
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('roles.index') }}";
                }
            });
        @endif
    </script>
@endsection
