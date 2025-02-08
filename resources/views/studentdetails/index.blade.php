@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="title-h3 fw-bold">Student Details</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="mb-3">
                <form action="" method="GET">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <a class="btn btn-custom w-100" href="{{ route('studentdetails.create') }}"
                                style="background-color: #151515; color: #fff;">
                                <i class="bi bi-plus-circle me-2"></i> Add New Student
                            </a>
                        </div>
                        <div class="col-md-7">
                            <input type="text" name="search" value="{{ request()->search }}" class="form-control"
                                placeholder="Search Student...">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fa-solid fa-search me-2"></i> Search
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead style="background-color: #0d6efd !important;">
                        <tr>
                            <th style="width: 5%; color: #000000 !important;">ID</th>
                            <th style="width: 10%; color: #000000 !important;">Student Code</th>
                            <th style="width: 15%; color: #000000 !important;">Name</th>
                            <th style="width: 8%; color: #000000 !important;">Profile</th>
                            <th style="width: 10%; color: #000000 !important;">Birth Date</th>
                            <th style="width: 5%; color: #000000 !important;">Age</th>
                            <th style="width: 15%; color: #000000 !important;">Address</th>
                            <th style="width: 8%; color: #000000 !important;">City</th>
                            <th style="width: 8%; color: #000000 !important;">District</th>
                            <th style="width: 8%; color: #000000 !important;">Contact</th>
                            <th style="width: 8%; color: #000000 !important;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($studentDetails->isEmpty())
                            <tr>
                                <td colspan="11" class="text-center py-4">No Data Available</td>
                            </tr>
                        @else
                            @foreach ($studentDetails as $studentDetail)
                                <tr>
                                    <td class="align-middle">{{ $studentDetail->id }}</td>
                                    <td class="align-middle">{{ $studentDetail->student_code }}</td>
                                    <td class="align-middle">{{ $studentDetail->first_name }}
                                        {{ $studentDetail->middle_name }}
                                        {{ $studentDetail->last_name }}</td>
                                        
                                    <td class="align-middle text-center">
                                        @if ($studentDetail->profile_image)
                                            <button type="button" class="btn btn-link p-0" data-bs-toggle="modal"
                                                data-bs-target="#profileModal{{ $studentDetail->id }}">
                                                <img src="{{ $studentDetail->profile_image }}" alt="Profile"
                                                    class="rounded-circle" width="40" height="40">
                                            </button>

                                            <!-- Profile Modal -->
                                            <div class="modal fade" id="profileModal{{ $studentDetail->id }}" tabindex="-1"
                                                aria-labelledby="profileModalLabel{{ $studentDetail->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="profileModalLabel{{ $studentDetail->id }}">
                                                                {{ $studentDetail->first_name }}
                                                                {{ $studentDetail->last_name }}'s Profile
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            <img src="{{ $studentDetail->profile_image }}" alt="Profile"
                                                                class="img-fluid rounded" style="max-height: 400px;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <span class="text-muted">No Image</span>
                                        @endif
                                    </td>
                                    <td class="align-middle">{{ date('d-m-Y', strtotime($studentDetail->birth_date)) }}
                                    </td>
                                    <td class="align-middle text-center">{{ $studentDetail->age }}</td>
                                    <td class="align-middle">{{ $studentDetail->address_one }}</td>
                                    <td class="align-middle">{{ $studentDetail->city }}</td>
                                    <td class="align-middle">{{ $studentDetail->district }}</td>
                                    <td class="align-middle">{{ $studentDetail->contact_no }}</td>
                                    <td class="align-middle">
                                        <div class="d-flex gap-1 justify-content-center">
                                            @can('view-studentdetail')
                                                <a class="btn btn-info btn-sm"
                                                    href="{{ route('studentdetails.show', $studentDetail->id) }}">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            @endcan
                                            @can('edit-studentdetail')
                                                <a class="btn btn-warning btn-sm"
                                                    href="{{ route('studentdetails.edit', $studentDetail->id) }}">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            @endcan
                                            @can('delete-studentdetail')
                                                <form action="{{ route('studentdetails.destroy', $studentDetail->id) }}"
                                                    method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm delete-btn"
                                                        data-id="{{ $studentDetail->id }}">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center">
        {{ $studentDetails->appends(request()->query())->links('pagination::bootstrap-4') }}
    </div>

    @if ($studentDetails->isEmpty() && request()->search != '')
        <script>
            Swal.fire({
                text: 'No results found!',
                icon: 'warning',
                confirmButtonText: 'OK',
                confirmButtonColor: '#151515',
                didOpen: () => {
                    const confirmButton = Swal.getConfirmButton();
                    confirmButton.style.color = '#fff';
                    confirmButton.style.backgroundColor = '#151515';
                    confirmButton.onmouseover = () => {
                        confirmButton.style.backgroundColor = '#4d4d4d';
                    };
                    confirmButton.onmouseleave = () => {
                        confirmButton.style.backgroundColor = '#151515';
                    };
                }
            }).then(() => {
                window.location.href = "{{ route('studentdetails.index') }}";
            });
        </script>
    @endif

    <script>
        $(document).on('click', '.delete-btn', function(e) {
            e.preventDefault();
            var studentId = $(this).data('id');

            Swal.fire({
                text: "Are you sure to delete the student ID " + studentId + "?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Delete it!',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#9d0a0e',
                cancelButtonColor: '#151515',
                didOpen: () => {
                    const confirmButton = Swal.getConfirmButton();
                    confirmButton.style.color = '#fff';
                    confirmButton.style.backgroundColor = '#9d0a0e';
                    confirmButton.onmouseover = () => {
                        confirmButton.style.backgroundColor = '#cf2d32';
                    };
                    confirmButton.onmouseleave = () => {
                        confirmButton.style.backgroundColor = '#9d0a0e';
                    };

                    const cancelButton = Swal.getCancelButton();
                    cancelButton.style.color = '#fff';
                    cancelButton.style.backgroundColor = '#151515';
                    cancelButton.onmouseover = () => {
                        cancelButton.style.backgroundColor = '#4d4d4d';
                    };
                    cancelButton.onmouseleave = () => {
                        cancelButton.style.backgroundColor = '#151515';
                    };
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/studentdetails/' + studentId,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(response) {
                            if (response && response.message) {
                                Swal.fire({
                                    text: response.message,
                                    icon: 'success',
                                    confirmButtonText: 'OK',
                                    confirmButtonColor: '#151515',
                                    didOpen: () => {
                                        const confirmButton = Swal
                                            .getConfirmButton();
                                        confirmButton.style.color = '#fff';
                                        confirmButton.style.backgroundColor =
                                            '#151515';
                                        confirmButton.onmouseover = () => {
                                            confirmButton.style
                                                .backgroundColor = '#4d4d4d';
                                        };
                                        confirmButton.onmouseleave = () => {
                                            confirmButton.style
                                                .backgroundColor = '#151515';
                                        };
                                    }
                                }).then(() => {
                                    window.location.reload();
                                });
                            } else {
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'There was a problem deleting the student.',
                                    icon: 'error',
                                    confirmButtonText: 'OK',
                                    confirmButtonColor: '#151515',
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                title: 'Error!',
                                text: 'There was a problem deleting the student.',
                                icon: 'error',
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#151515',
                            });
                        }
                    });
                }
            });
        });
    </script>

    <!-- Initialize all modals -->
    <script>
        var profileModals = document.querySelectorAll('.modal');
        profileModals.forEach(function(modal) {
            new bootstrap.Modal(modal);
        });
    </script>
@endsection

@section('styles')
    <style>
        .card {
            border-radius: 8px;
            border: none;
        }

        .table {
            margin-bottom: 0;
        }

        .table thead th {
            border-bottom: 2px solid #dee2e6;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.875rem;
        }

        .table tbody td {
            font-size: 0.875rem;
            vertical-align: middle;
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

        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }

        .rounded-circle {
            object-fit: cover;
        }

        .title-h3 {
            color: #151515;
            margin-bottom: 0;
        }

        .form-control {
            border-radius: 4px;
            padding: 0.5rem 1rem;
        }

        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }

        .table-hover tbody tr:hover {
            background-color: rgba(13, 110, 253, 0.05);
        }

        .pagination {
            margin-top: 1.5rem;
        }

        .btn-link {
            text-decoration: none;
        }

        .btn-link:hover img {
            transform: scale(1.1);
            transition: transform 0.2s ease-in-out;
        }

        .modal-content {
            border: none;
            border-radius: 8px;
        }

        .modal-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .modal-body {
            padding: 1.5rem;
        }

        .img-fluid {
            max-width: 100%;
            height: auto;
        }
    </style>
@endsection
