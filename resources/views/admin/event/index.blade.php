@extends('admin.layout.app')

@section('style')
    @parent
    <link rel="stylesheet" href="{{ asset('assets/admin/css/dataTables.bootstrap5.min.css') }}" />
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item active"><span>Events</span></li>
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
                                <strong>Events</strong>
                                <a href="{{ route('admin.event.create') }}" class="btn btn-primary permission float-end">
                                    <i class="fa fa-plus"></i> Add New Event
                                </a>
                            </div>
                            <div class="card-body table-listing table-responsive">
                                <table class="table event-table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Title</th>
                                            <th>Status</th>
                                            <th>Time Remaining</th>
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                            <th>Active</th>
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
            var table = $('.event-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.event.index') }}",
                columns: [
                    { data: 'image_preview', name: 'image_preview', orderable: false, searchable: false },
                    { data: 'title', name: 'title' },
                    { data: 'status_badge', name: 'status' },
                    { data: 'time_remaining', name: 'time_remaining', orderable: false },
                    { data: 'start_time', name: 'start_time' },
                    { data: 'end_time', name: 'end_time' },
                    { data: 'is_active_display', name: 'is_active' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center' }
                ],
                order: [[7, 'desc']]
            });

            // Handle delete
            $(document).on('click', '.delete-btn', function(e) {
                e.preventDefault();
                var url = $(this).data('url');
                
                if (confirm('Are you sure you want to delete this event?')) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                table.ajax.reload();
                                alert(response.success);
                            }
                        },
                        error: function() {
                            alert('Error deleting event');
                        }
                    });
                }
            });

            // Handle restore
            $(document).on('click', '.restore-btn', function(e) {
                e.preventDefault();
                var url = $(this).data('url');
                
                if (confirm('Are you sure you want to restore this event?')) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                table.ajax.reload();
                                alert(response.success);
                            }
                        },
                        error: function() {
                            alert('Error restoring event');
                        }
                    });
                }
            });

            // Handle force delete
            $(document).on('click', '.force-delete-btn', function(e) {
                e.preventDefault();
                var url = $(this).data('url');
                
                if (confirm('Are you sure you want to permanently delete this event? This action cannot be undone!')) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                table.ajax.reload();
                                alert(response.success);
                            }
                        },
                        error: function() {
                            alert('Error permanently deleting event');
                        }
                    });
                }
            });

            // Handle toggle status
            $(document).on('click', '.toggle-status', function(e) {
                e.preventDefault();
                var url = $(this).data('url');
                
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            table.ajax.reload();
                            alert(response.success);
                        }
                    },
                    error: function() {
                        alert('Error updating event status');
                    }
                });
            });
        });
    </script>
@endsection
