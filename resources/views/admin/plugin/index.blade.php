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
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-header">
                                <strong>Install Plugin</strong>
                            </div>
                            <div class="card-body table-listing table-responsive">
                                {{ html()->form('POST', route("admin.plugin.install"))->acceptsFiles()->open() }}
                                    <div class="row">
                                        <div class="col-md-12 search-filter">
                                            {{ html()->file('plugin')->class('form-control')->required() }}
                                        </div>
                                        <div class="col-md-12 text-right mt-3">
                                            <button type="submit" class="btn btn-primary w-100" id="form-submit">Install</button>
                                        </div>
                                    </div>
                                {{ html()->form()->close() }}
                            </div>
                        </div>
                    </div>
                    <!-- /.col-->
                    <div class="col-sm-8">
                        <div class="card">
                            <div class="card-header">
                                <strong>Plugin</strong>
                            </div>
                            <div class="card-body table-listing table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Key</th>
                                            <th>Group</th>
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
                    url: '{!! route('admin.plugin.index') !!}'
                },
                columns: [{
                        data: 'key',
                        name: 'key'
                    },
                    {
                        data: 'group',
                        name: 'group'
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
        });
    </script>
@endsection
