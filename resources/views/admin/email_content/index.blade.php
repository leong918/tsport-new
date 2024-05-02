@extends('admin.layout.app')

@section('style')
    @parent
    <link rel="stylesheet" href="{{ asset('assets/admin/css/dataTables.bootstrap5.min.css') }}" />
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
                                <strong>Email</strong>
                                <a href="{{ route("admin.email_content.create") }}" class="btn btn-primary permission float-end">
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>
                            <div class="card-body table-listing table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Subject</th>
                                            <th>Last Sent On</th>
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
    <script type="text/javascript">
        $(document).ready(function() {
            $(function() {
                var table = $('.table').DataTable({
                    bSort: true,
                    processing: true,
                    autoWidth: false,
                    serverSide: true,
                    ajax: {
                        url: '{!! route('admin.email_content.index') !!}'
                    },
                    columns: [
                        {
                            data: 'subject',
                            name: 'subject'
                        },
                        {
                            data: 'last_sent_on',
                            name: 'last_sent_on'
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
                                text: 'Record deleted successfully!',
                                icon: 'success',
                            });
                            // reload datatables
                            table.ajax.reload();
                        }
                    });
                });

                $('table tbody').on('click', '.btn-subscriber-mail', function(e) {
                    e.preventDefault();
                    var url = $(this).data('url');
                    var subject = $(this).data('subject');
                    swal.fire({
                        title: 'Are you sure?',
                        text: 'This action will send email (' + subject + ') to the user.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, send it!',
                        cancelButtonText: 'Cancel',
                        customClass: {
                            confirmButton: "btn btn-success me-2",
                            cancelButton: "btn btn-danger ms-2"
                        },
                        buttonsStyling: false,
                        showLoaderOnConfirm: true,
                        preConfirm: (response) => {
                            if (response) {
                                return axios.get(url, {})
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
                                title: 'Success!',
                                text: 'Email (' + subject + ') sent successfully!',
                                icon: 'success',
                            });
                        }
                    });
                });
            });
        });
    </script>
@endsection
