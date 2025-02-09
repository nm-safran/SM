@extends('layouts.app')

@section('content')
    <div class="card shadow-lg border-0 rounded-3">
        <div class="card-header bg-gradient bg-primary text-white d-flex justify-content-between align-items-center py-3">
            <h5 class="mb-0 ms-2 fw-semibold">
                <i class="bi bi-people me-2"></i>Manage Users
            </h5>
            @can('create-user')
                <a href="{{ route('users.create') }}" class="btn btn-light btn-sm rounded-pill px-3 shadow-sm hover-scale">
                    <i class="bi bi-plus-circle me-1"></i>Add New User
                </a>
            @endcan
        </div>
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle border-bottom">
                    <thead>
                        <tr class="bg-light">
                            <th scope="col" width="5%" class="rounded-start-2">#</th>
                            <th scope="col" width="20%">Name</th>
                            <th scope="col" width="25%">Email</th>
                            <th scope="col" width="25%">Roles</th>
                            <th scope="col" width="25%" class="rounded-end-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr class="align-middle">
                                <th scope="row" class="fw-medium">{{ $loop->iteration }}</th>
                                <td>
                                    <span class="fw-semibold text-primary">{{ $user->name }}</span>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <div class="d-flex flex-wrap gap-2">
                                        @forelse ($user->getRoleNames() as $role)
                                            <span
                                                class="badge rounded-pill bg-success bg-opacity-25 text-success border border-success border-opacity-25">
                                                {{ $role }}
                                            </span>
                                        @empty
                                            <span class="badge rounded-pill bg-light text-secondary border">
                                                <i class="bi bi-exclamation-circle me-1"></i>No roles assigned
                                            </span>
                                        @endforelse
                                    </div>
                                </td>
                                <td>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="post"
                                        class="d-flex gap-2">
                                        @csrf
                                        @method('DELETE')

                                        @if (in_array('Super Admin', $user->getRoleNames()->toArray() ?? []))
                                            @if (Auth::user()->hasRole('Super Admin'))
                                                <a href="{{ route('users.edit', $user->id) }}"
                                                    class="btn btn-outline-primary btn-sm rounded-pill px-3 hover-scale">
                                                    <i class="bi bi-pencil-square me-1"></i>Edit
                                                </a>
                                            @endif
                                        @else
                                            @can('edit-user')
                                                <a href="{{ route('users.edit', $user->id) }}"
                                                    class="btn btn-outline-primary btn-sm rounded-pill px-3 hover-scale">
                                                    <i class="bi bi-pencil-square me-1"></i>Edit
                                                </a>
                                            @endcan

                                            @can('delete-user')
                                                @if (Auth::user()->id != $user->id)
                                                    <button type="submit"
                                                        class="btn btn-outline-danger btn-sm rounded-pill px-3 hover-scale"
                                                        onclick="return confirm('Do you want to delete this user?');">
                                                        <i class="bi bi-trash me-1"></i>Delete
                                                    </button>
                                                @endif
                                            @endcan
                                        @endif
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="bi bi-folder2-open display-6 d-block mb-3 text-secondary opacity-50"></i>
                                        <h6 class="fw-semibold">No Users Found!</h6>
                                        <p class="small text-secondary">Start by adding a new user to the system.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $users->links() }}
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

        .table> :not(caption)>*>* {
            padding: 1rem 1rem;
        }

        .badge {
            font-weight: 500;
            letter-spacing: 0.3px;
        }
    </style>
@endsection
