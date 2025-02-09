@extends('layouts.app')

@section('content')
    <div class="card shadow-lg border-0 rounded-3">
        <div class="card-header bg-gradient bg-primary text-white d-flex justify-content-between align-items-center py-3">
            <h5 class="mb-0 ms-2 fw-semibold">
                <i class="bi bi-person-gear me-2"></i>Edit User
            </h5>
            <a href="{{ route('users.index') }}" class="btn btn-light btn-sm rounded-pill px-3 shadow-sm hover-scale">
                <i class="bi bi-arrow-left me-1"></i>Back
            </a>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('users.update', $user->id) }}" method="post">
                @csrf
                @method('PUT')

                <div class="row mb-4">
                    <label for="name" class="col-md-3 col-form-label text-md-end fw-semibold">Name</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ $user->name }}" placeholder="Enter user name">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-4">
                    <label for="email" class="col-md-3 col-form-label text-md-end fw-semibold">Email Address</label>
                    <div class="col-md-6">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" value="{{ $user->email }}" placeholder="Enter email address">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-4">
                    <label for="password" class="col-md-3 col-form-label text-md-end fw-semibold">Password</label>
                    <div class="col-md-6">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                            name="password" placeholder="Enter new password">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">
                            Leave blank to keep current password
                        </small>
                    </div>
                </div>

                <div class="row mb-4">
                    <label for="password_confirmation" class="col-md-3 col-form-label text-md-end fw-semibold">Confirm
                        Password</label>
                    <div class="col-md-6">
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                            placeholder="Confirm new password">
                    </div>
                </div>

                <div class="row mb-4">
                    <label for="roles" class="col-md-3 col-form-label text-md-end fw-semibold">Roles</label>
                    <div class="col-md-6">
                        <select class="form-select @error('roles') is-invalid @enderror" multiple id="roles"
                            name="roles[]" size="4">
                            @forelse ($roles as $role)
                                @if ($role != 'Super Admin')
                                    <option value="{{ $role }}"
                                        {{ in_array($role, $userRoles ?? []) ? 'selected' : '' }}>
                                        {{ $role }}
                                    </option>
                                @else
                                    @if (Auth::user()->hasRole('Super Admin'))
                                        <option value="{{ $role }}"
                                            {{ in_array($role, $userRoles ?? []) ? 'selected' : '' }}>
                                            {{ $role }}
                                        </option>
                                    @endif
                                @endif
                            @empty
                                <option disabled>No roles available</option>
                            @endforelse
                        </select>
                        @error('roles')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Hold Ctrl/Cmd to select multiple roles</div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <button type="submit" class="btn btn-primary rounded-pill px-4 hover-scale">
                            <i class="bi bi-check-circle me-1"></i>Update User
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <style>
        .hover-scale {
            transition: transform 0.2s ease;
        }

        .hover-scale:hover {
            transform: scale(1.05);
        }

        .form-control,
        .form-select {
            border-radius: 0.5rem;
            padding: 0.5rem 1rem;
        }

        .form-control:focus,
        .form-select:focus {
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
        }
    </style>
@endsection
