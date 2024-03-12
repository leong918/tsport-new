@extends('admin.layout.app')

@section('style')
    @parent
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" />
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
                                <strong>Tag</strong>
                                <a href="{{ route("admin.tag.create") }}" class="btn btn-primary permission float-end">
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>
                            <div class="card-body table-listing table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
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
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(function() {
                var table = $('.table').DataTable({
                    bSort: true,
                    processing: true,
                    autoWidth: false,
                    serverSide: true,
                    ajax: {
                        url: '{!! route('admin.tag.index') !!}'
                    },
                    columns: [
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            searchable: false,
                            sortable: false,
                        }
                    ]
                });

                $('table tbody').on('click', '.btn-delete', function(e) {
                    e.preventDefault();
                    var url = $(this).data('url');
                    Swal.fire({
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
                        allowOutsideClick: () => !swal.isLoading()
                    }).then((result) => {
                        if (result.value) {
                            Swal.fire({
                                title: 'Deleted!',
                                text: 'Record deleted successfully!',
                                icon: 'success',
                            });
                            // reload datatables
                            table.ajax.reload();
                        }
                    });
                });

                $('table tbody').on('click', '.btn-status', function() {
                    var url = $(this).data("url");
                    Swal.fire({
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
                        allowOutsideClick: () => !swal.isLoading()
                    }).then((result) => {
                        if (result.value) {
                            Swal.fire({
                                title: 'Updated!',
                                text: 'Record updated successfully!',
                                icon: 'success',
                            });
                            // reload datatables
                            table.ajax.reload();
                        }
                    });
                });
            });
        });
    </script>
@endsection
