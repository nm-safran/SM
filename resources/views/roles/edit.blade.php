@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-start">
                        Edit Role
                    </div>
                    <div class="float-end">
                        <a href="{{ route('roles.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                    </div>
                </div>
                <div class="card-body">
                    @if (auth()->user()->hasRole('Super Admin'))
                        <form id="update-role-form" action="{{ route('roles.update', $role->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="mb-3 row">
                                <label for="name" class="col-md-4 col-form-label text-md-end text-start">Name</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" value="{{ $role->name }}">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="permissions"
                                    class="col-md-4 col-form-label text-md-end text-start">Permissions</label>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        @forelse ($permissions as $permission)
                                            <div>
                                                <input class="form-check-input @error('permissions') is-invalid @enderror"
                                                    type="checkbox" id="permission{{ $permission->id }}"
                                                    name="permissions[]" value="{{ $permission->id }}"
                                                    {{ in_array($permission->id, $rolePermissions ?? []) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="permission{{ $permission->id }}">
                                                    {{ $permission->name }}
                                                </label>
                                            </div>
                                        @empty
                                            <p>No permissions available</p>
                                        @endforelse
                                    </div>
                                    @error('permissions')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Update Role">
                            </div>
                        </form>
                    @else
                        <div class="alert alert-danger">
                            You do not have permission to edit roles.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
        document.getElementById('update-role-form').addEventListener('submit', function(event) {
            event.preventDefault();
            var form = this;
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to update this role!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, update it!'
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
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = "{{ route('roles.index') }}";
            });
        @endif

        document.querySelector('.btn-primary.btn-sm').addEventListener('click', function(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Navigating!',
                text: 'You will be redirected to the roles index page.',
                icon: 'info',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = "{{ route('roles.index') }}";
            });
        });
    </script>
@endsection
