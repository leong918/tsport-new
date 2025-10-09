@extends('admin.layout.app')

@section('style')
    @parent
    <link rel="stylesheet" href="{{ asset('assets/admin/css/dataTables.bootstrap5.min.css') }}" />
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item active"><span>Predict</span></li>
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
                                <strong>Predict</strong>
                                <a href="{{ route('admin.predict.create') }}" class="btn btn-primary permission float-end">
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>
                            <div class="card-body table-listing table-responsive">
                                <table class="table predict-table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Character Name</th>
                                            <th>Match Title</th>
                                            <th>Comment</th>
                                            <th>Like</th>
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
    <script src="{{ asset('assets/admin/js/bootstrap.min.js') }}"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(function() {
                var table = $('.predict-table').DataTable({
                    bSort: true,
                    processing: true,
                    autoWidth: false,
                    serverSide: true,
                    ordering: false,
                    ajax: {
                        url: "{!! route('admin.predict.index') !!}",
                        data: function(d) {
                            var form = {};
                            $.each($('#form').serializeArray(), function() {
                                form[this.name] = this.value;
                            });
                            d.form_data = form;
                        },
                    },
                    columns: [{
                            data: 'character_name',
                            name: 'character_name',
                            width: '30%'
                        },
                        {
                            data: 'match_title',
                            name: 'match_title'
                        },
                        {
                            data: 'comment',
                            name: 'comment'
                        },
                        {
                            data: 'like',
                            name: 'like'
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

                $('#form-submit').click(function() {
                    table.draw();
                })

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
                            table.ajax.reload();
                        }
                    });
                });

                $('table tbody').on('click', '.btn-status', function() {
                    var url = $(this).data("url");
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
                                text: 'Record updated successfully!',
                                icon: 'success',
                            });
                            // reload datatables
                            table.ajax.reload();
                        }
                    });
                });

                $('table tbody').on('click', '.btn-comment', function(e) {
                    $('.index-table').data('dt_params', {
                        id: $(this).data('id')
                    });
                    $('.index-table').DataTable().draw();
                    indexTable.draw();
                });
            });
        });
    </script>
@endsection
