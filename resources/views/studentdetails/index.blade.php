@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="d-flex justify-content-between align-items-center">
                <div class="pull-left">
                    <h3 class="title-h3">Student Details</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-3 row">
        <div class="col-md-12">
            <form action="" method="GET">
                <div class="row g-2">
                    <div class="col">
                        <a class="mb-2 btn btn-custom" href="{{ route('studentdetails.create') }}">
                            <i class="bi bi-plus-circle"></i> Add New Student
                        </a>
                    </div>
                    <div class="col">
                        <input type="text" name="search" value="{{ request()->search }}" class="form-control"
                            placeholder="Search Student...">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-customsub"><i class="fa-solid fa-search"></i> Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Student Code</th>
                <th>Name</th>
                <th>Profile Image</th>
                <th>Birth Date</th>
                <th>Age</th>
                <th>Address</th>
                <th>City</th>
                <th>District</th>
                <th>Contact No</th>
                <th width="160px">Actions</th>
            </tr>
        </thead>
        <tbody>
            @if ($studentDetails->isEmpty())
                <tr>
                    <td colspan="11" class="text-center">No Data Available</td>
                </tr>
            @else
                @foreach ($studentDetails as $studentDetail)
                    <tr>
                        <td>{{ $studentDetail->id }}</td>
                        <td>{{ $studentDetail->student_code }}</td>
                        <td>{{ $studentDetail->first_name }} {{ $studentDetail->middle_name }}
                            {{ $studentDetail->last_name }}</td>
                        <td><img src="{{ $studentDetail->profile_image }}" alt="Profile Image" width="50"></td>
                        <td>{{ $studentDetail->birth_date }}</td>
                        <td>{{ $studentDetail->age }}</td>
                        <td>{{ $studentDetail->address_one }}</td>
                        <td>{{ $studentDetail->city }}</td>
                        <td>{{ $studentDetail->district }}</td>
                        <td>{{ $studentDetail->contact_no }}</td>
                        <td>
                            @can('view-studentdetail')
                                <a class="btn btn-info btn-sm" href="{{ route('studentdetails.show', $studentDetail->id) }}">
                                    <i class="fas fa-eye"></i>
                                </a>
                            @endcan
                            @can('edit-studentdetail')
                                <a href="{{ route('studentdetails.edit', $studentDetail->id) }}"
                                    class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                            @endcan
                            @can('delete-studentdetail')
                                <form action="{{ route('studentdetails.destroy', $studentDetail->id) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm delete-btn"
                                        data-id="{{ $studentDetail->id }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

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

    <div class="mt-2 d-flex justify-content-center" style="margin-bottom: 0;">
        {{ $studentDetails->links('pagination::bootstrap-4') }}
    </div>
@endsection

@section('styles')
    <style>
        .swal2-confirm,
        .swal2-cancel {
            transition: background-color 0.3s, box-shadow 0.3s;
        }

        .swal2-confirm:hover,
        .swal2-cancel:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
    </style>
@endsection
