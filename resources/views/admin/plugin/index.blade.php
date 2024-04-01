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
                        <div class="card mb-3">
                            <div class="card-header">
                                <strong>Installed Plugin</strong>
                            </div>
                            <div class="card-body table-listing table-responsive">
                                <table class="table table-bordered main-table">
                                    <thead>
                                        <tr>
                                            <th>Key</th>
                                            <th>Group</th>
                                            <th>Installed At</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($installed_plugins as $installed_plugin)
                                        <tr>
                                            <td>{{ $installed_plugin->key }}</td>
                                            <td>{{ $installed_plugin->group }}</td>
                                            <td>{{ $installed_plugin->created_at }}</td>
                                            <td>
                                                <div class='text-center'>
                                                    <a href="#" data-url='{{route('admin.plugin.destroy.delete', ['id' => $installed_plugin->id])}}'
                                                        class='btn btn-delete btn-danger'><i class="fa fa-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <strong>Uninstalled Plugin</strong>
                            </div>
                            <div class="card-body table-listing table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Key</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($uninstalled_plugins as $uninstalled_plugin)
                                        <tr>
                                            <td>{{ $uninstalled_plugin }}</td>
                                            <td>
                                                <div class='text-center'>
                                                    <a href="#" data-url='{{route('admin.plugin.reinstall', ['name' => $uninstalled_plugin])}}'
                                                        class='btn btn-install btn-success'><i class="fa fa-download"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
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
    <script type="text/javascript">
        $(function() {
            // delete record
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
                                    setTimeout(function() {
                                        window.location.reload();
                                    }, 1000);
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
                        // reload pages
                        window.location.reload();
                    }
                });
            });

            // install plugin
            $('table tbody').on('click', '.btn-install', function(e) {
                e.preventDefault();
                var url = $(this).data('url');
                swal.fire({
                    title: 'Are you sure?',
                    text: 'This action is not able to be reverted.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, install it!',
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
                                    setTimeout(function() {
                                        window.location.reload();
                                    }, 1000);
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
                            title: 'Installed!',
                            text: 'Plugin installed successfully!',
                            icon: 'success',
                        });
                        // reload pages
                        window.location.reload();
                    }
                });
            });
        });
    </script>
@endsection
