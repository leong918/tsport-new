@extends('admin.layout.app')

@section('style')
    @parent
    <link rel="stylesheet" href="{{ asset('assets/admin/css/dataTables.bootstrap5.min.css') }}" />
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item active"><span>Users</span></li>
@endsection

@section('content')
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <x-alert />
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <strong>Users</strong>
                            </div>
                            <div class="card-body table-listing table-responsive">
                                <table class="table user-table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Jersey Name</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('script')
    @parent
    <script src="{{ asset('assets/admin/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/dataTables.bootstrap5.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            var table = $('.user-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.user.index') }}",
                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'username', name: 'username' },
                    { data: 'email', name: 'email' },
                    { data: 'phone_no', name: 'phone_no' },
                    { data: 'jersey_name', name: 'jersey_name' },
                    { data: 'status', name: 'status', orderable: false },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center' }
                ],
                order: [[6, 'desc']]
            });

            // Handle delete
            $(document).on('click', '.delete-btn', function(e) {
                e.preventDefault();
                var url = $(this).data('url');
                
                swal.fire({
                    title: 'Are you sure?',
                    text: 'This action is not able to be reverted.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel',
                    customClass: {
                        confirmButton: "btn btn-success me-2",
                        cancelButton: "btn btn-danger ms-2"
                    },
                    buttonsStyling: false,
                    showLoaderOnConfirm: true,
                    preConfirm: (response) => {
                        if (response) {
                            return axios.delete(url, {})
                                .then(() => {
                                    table.ajax.reload();
                                })
                                .catch((e) => {
                                    console.error("error ", e)
                                    Swal.showValidationMessage(
                                        `Request failed: ${e}`
                                    );
                                })
                        }
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                    if (result.value) {
                        swal.fire({
                            title: 'Deleted!',
                            text: 'User deleted successfully!',
                            icon: 'success',
                        });
                        table.ajax.reload();
                    }
                });
            });

            // Handle toggle status (badge click)
            $(document).on('click', '.btn-status', function(e) {
                e.preventDefault();
                var url = $(this).data('url');
                
                swal.fire({
                    title: 'Are you sure?',
                    text: 'This action is not able to be reverted.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, change it!',
                    cancelButtonText: 'Cancel',
                    customClass: {
                        confirmButton: "btn btn-success me-2",
                        cancelButton: "btn btn-danger ms-2"
                    },
                    buttonsStyling: false,
                    showLoaderOnConfirm: true,
                    preConfirm: (response) => {
                        if (response) {
                            return axios.post(url, {})
                                .then(() => {
                                    table.ajax.reload();
                                })
                                .catch((e) => {
                                    console.error("error ", e)
                                    Swal.showValidationMessage(
                                        `Request failed: ${e}`
                                    );
                                })
                        }
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                    if (result.value) {
                        swal.fire({
                            title: 'Updated!',
                            text: 'User status updated successfully!',
                            icon: 'success',
                        });
                        table.ajax.reload();
                    }
                });
            });
        });
    </script>
@endsection
