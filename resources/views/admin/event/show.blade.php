@extends('admin.layout.app')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.event.index') }}">Events</a></li>
    <li class="breadcrumb-item active"><span>View Event</span></li>
@endsection

@section('content')
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <strong>Event Details: {{ $event->title }}</strong>
                                <div class="float-end">
                                    @if(!$event->deleted_at)
                                        <a href="{{ route('admin.event.edit', $event->id) }}" class="btn btn-warning me-2">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>
                                    @endif
                                    <a href="{{ route('admin.event.index') }}" class="btn btn-secondary">
                                        <i class="fa fa-arrow-left"></i> Back to List
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                @if($event->deleted_at)
                                    <div class="alert alert-danger mb-4">
                                        <i class="fa fa-exclamation-triangle"></i>
                                        <strong>This event has been deleted on {{ $event->deleted_at->format('Y-m-d H:i:s') }}</strong>
                                    </div>
                                @endif
                                
                                <div class="row">
                                    <div class="col-md-8">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <th width="150">Title:</th>
                                                    <td>{{ $event->title }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Status:</th>
                                                    <td>
                                                        @if($event->deleted_at)
                                                            <span class="badge bg-danger">Deleted</span>
                                                        @else
                                                            @php
                                                                $class = $event->status === 'active' ? 'success' : ($event->status === 'upcoming' ? 'warning' : 'secondary');
                                                            @endphp
                                                            <span class="badge bg-{{ $class }}">{{ ucfirst($event->status) }}</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Active:</th>
                                                    <td>
                                                        <span class="badge bg-{{ $event->is_active ? 'success' : 'secondary' }}">
                                                            {{ $event->is_active ? 'Yes' : 'No' }}
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Time Remaining:</th>
                                                    <td>{{ $event->time_remaining ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Start Time:</th>
                                                    <td>{{ $event->start_time ? $event->start_time->format('Y-m-d H:i:s') : 'Not set' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>End Time:</th>
                                                    <td>{{ $event->end_time ? $event->end_time->format('Y-m-d H:i:s') : 'Not set' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Created At:</th>
                                                    <td>{{ $event->created_at->format('Y-m-d H:i:s') }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Updated At:</th>
                                                    <td>{{ $event->updated_at->format('Y-m-d H:i:s') }}</td>
                                                </tr>
                                                @if($event->deleted_at)
                                                <tr>
                                                    <th>Deleted At:</th>
                                                    <td>{{ $event->deleted_at->format('Y-m-d H:i:s') }}</td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-4">
                                        @if($event->image)
                                            <div class="text-center">
                                                <h6>Event Image</h6>
                                                <img src="{{ $event->image_url }}" 
                                                     alt="{{ $event->title }}" 
                                                     class="img-fluid border rounded" 
                                                     style="max-width: 100%; max-height: 300px;">
                                            </div>
                                        @else
                                            <div class="text-center text-muted">
                                                <i class="fa fa-image fa-3x mb-3"></i>
                                                <p>No image uploaded</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                
                                @if(!$event->deleted_at)
                                    <div class="mt-4 pt-3 border-top">
                                        <h6>Actions</h6>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.event.edit', $event->id) }}" class="btn btn-warning">
                                                <i class="fa fa-edit"></i> Edit Event
                                            </a>
                                            <button type="button" class="btn btn-secondary toggle-status" 
                                                    data-url="{{ route('admin.event.toggle-status', $event->id) }}">
                                                <i class="fa fa-{{ $event->is_active ? 'pause' : 'play' }}"></i> 
                                                {{ $event->is_active ? 'Deactivate' : 'Activate' }}
                                            </button>
                                            <button type="button" class="btn btn-danger delete-btn" 
                                                    data-url="{{ route('admin.event.destroy', $event->id) }}">
                                                <i class="fa fa-trash"></i> Delete Event
                                            </button>
                                        </div>
                                    </div>
                                @else
                                    <div class="mt-4 pt-3 border-top">
                                        <h6>Restore Actions</h6>
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-success restore-btn" 
                                                    data-url="{{ route('admin.event.restore', $event->id) }}">
                                                <i class="fa fa-undo"></i> Restore Event
                                            </button>
                                            <button type="button" class="btn btn-danger force-delete-btn" 
                                                    data-url="{{ route('admin.event.force-delete', $event->id) }}">
                                                <i class="fa fa-trash-alt"></i> Permanently Delete
                                            </button>
                                        </div>
                                    </div>
                                @endif
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
    <script>
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
                        location.reload();
                    }
                },
                error: function() {
                    alert('Error updating event status');
                }
            });
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
                            window.location.href = '{{ route("admin.event.index") }}';
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
                            location.reload();
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
                            window.location.href = '{{ route("admin.event.index") }}';
                        }
                    },
                    error: function() {
                        alert('Error permanently deleting event');
                    }
                });
            }
        });
    </script>
@endsection
