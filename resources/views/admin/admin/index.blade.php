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
                                <strong>Admin</strong>
                                <a href="{{ route("admin.admin.create") }}" class="btn btn-primary permission float-end">
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>
                            <div class="card-body table-listing table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Username</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-->
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
        $(function() {
            var table = $('.table').DataTable({
                bSort: true,
                processing: true,
                autoWidth: false,
                serverSide: true,
                ajax: {
                    url: '{!! route('admin.admin.index') !!}'
                },
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'username',
                        name: 'username'
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

            // delete record
            $('table tbody').on('click', '.btn-delete', function(e) {
                e.preventDefault();
                var url = $(this).data('url');
                swal.queue([{
                    title: '{{ __('page.txt_confirm') }}',
                    text: '{{ __('page.txt_no_revert') }}',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: '{{ __('page.txt_delete') }}',
                    cancelButtonText: '{{ __('page.txt_cancel') }}',
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
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
                                    swal.showValidationMessage(
                                        `Request failed: ${e}`
                                    );
                                })
                        }
                    },
                    allowOutsideClick: () => !swal.isLoading()
                }]).then((result) => {
                    if (result.value) {
                        swal.fire({
                            title: '{{ __('page.deleted') }}',
                            text: '{{ __('page.txt_deleted') }}',
                            type: 'success',
                            confirmButtonClass: 'btn btn-success',
                            confirmButtonText: '{{ __('page.ok') }}',
                        });
                        // reload datatables
                        table.ajax.reload();
                    }
                });
            });

            //status toggle 
            $('table tbody').on('click', '.btn-status', function() {
                var url = $(this).data("url");
                swal.queue([{
                    title: '{{ __('page.txt_confirm') }}',
                    text: '{{ __('page.txt_status_record') }}',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: '{{ __('page.txt_status_confirm') }}',
                    cancelButtonText: '{{ __('page.txt_cancel') }}',
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
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
                                    swal.showValidationMessage(
                                        `Request failed: ${e}`
                                    );
                                })
                        }
                    },
                    allowOutsideClick: () => !swal.isLoading()
                }]).then((result) => {
                    if (result.value) {
                        swal.fire({
                            title: '{{ __('page.status_updated') }}',
                            text: '{{ __('page.txt_status_updated') }}',
                            type: 'success',
                            confirmButtonClass: 'btn btn-success',
                        });
                        // reload datatables
                        table.ajax.reload();
                    }
                });
            });
        });
    </script>
@endsection
