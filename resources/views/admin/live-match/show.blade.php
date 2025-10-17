@extends('admin.layout.app')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.live-match.index') }}">Live Match</a></li>
    <li class="breadcrumb-item active"><span>Details</span></li>
@endsection

@section('content')
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <x-alert />
                <div class="row">
                    <div class="col-lg-8">
                        <!-- Live Match Info -->
                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <strong>Live Match Information</strong>
                                <div>
                                    @if($model->obs_status == 2)
                                        <span class="badge bg-danger fs-6">LIVE</span>
                                    @elseif($model->obs_status == 1)
                                        <span class="badge bg-warning fs-6">STARTING</span>
                                    @elseif($model->obs_status == 3)
                                        <span class="badge bg-info fs-6">STOPPING</span>
                                    @else
                                        <span class="badge bg-secondary fs-6">STOPPED</span>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body">
                                @if($model->match)
                                <div class="row mb-3">
                                    <div class="col-md-3 fw-bold">Match:</div>
                                    <div class="col-md-9">{{ $model->match->match_title }}</div>
                                </div>
                                @if($model->match->short_content)
                                <div class="row mb-3">
                                    <div class="col-md-3 fw-bold">Description:</div>
                                    <div class="col-md-9">{{ $model->match->short_content }}</div>
                                </div>
                                @endif
                                @if($model->match->start_at)
                                <div class="row mb-3">
                                    <div class="col-md-3 fw-bold">Scheduled Start:</div>
                                    <div class="col-md-9">{{ \Carbon\Carbon::parse($model->match->start_at)->format('M d, Y H:i:s') }}</div>
                                </div>
                                @endif
                                @endif

                                <div class="row mb-3">
                                    <div class="col-md-3 fw-bold">Viewer Count:</div>
                                    <div class="col-md-9">
                                        <span class="badge bg-primary fs-6" id="viewer-count">{{ number_format($model->viewer_count) }}</span>
                                        <button class="btn btn-sm btn-outline-secondary ms-2" onclick="updateViewerCount()">
                                            <i class="fa fa-refresh"></i> Update
                                        </button>
                                    </div>
                                </div>

                                @if($streamingDuration)
                                <div class="row mb-3">
                                    <div class="col-md-3 fw-bold">Stream Duration:</div>
                                    <div class="col-md-9">{{ $streamingDuration }} minutes</div>
                                </div>
                                @endif

                                @if($model->stream_started_at)
                                <div class="row mb-3">
                                    <div class="col-md-3 fw-bold">Started At:</div>
                                    <div class="col-md-9">{{ $model->stream_started_at->format('M d, Y H:i:s') }} ({{ $model->stream_started_at->diffForHumans() }})</div>
                                </div>
                                @endif

                                @if($model->stream_ended_at)
                                <div class="row mb-3">
                                    <div class="col-md-3 fw-bold">Ended At:</div>
                                    <div class="col-md-9">{{ $model->stream_ended_at->format('M d, Y H:i:s') }} ({{ $model->stream_ended_at->diffForHumans() }})</div>
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- OBS Configuration -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <strong>OBS Configuration</strong>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-3 fw-bold">Server URL:</div>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="obs-server-url" value="{{ $model->obs_server_url }}" readonly>
                                            <button class="btn btn-outline-secondary" onclick="copyToClipboard('obs-server-url')">
                                                <i class="fa fa-copy"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-3 fw-bold">Stream Key:</div>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="obs-stream-key" value="{{ $model->obs_stream_key }}" readonly>
                                            <button class="btn btn-outline-secondary" onclick="copyToClipboard('obs-stream-key')">
                                                <i class="fa fa-copy"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-3 fw-bold">Complete RTMP URL:</div>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="rtmp-url" value="{{ $model->rtmp_url ?: $model->generateRtmpUrl() }}" readonly>
                                            <button class="btn btn-outline-secondary" onclick="copyToClipboard('rtmp-url')">
                                                <i class="fa fa-copy"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>

                        <!-- Recent Comments -->
                        @if($model->comments && $model->comments->count() > 0)
                        <div class="card">
                            <div class="card-header">
                                <strong>Recent Comments ({{ $model->comments->count() }})</strong>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th>User</th>
                                                <th>Comment</th>
                                                <th>Posted</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($model->comments->take(10) as $comment)
                                            <tr>
                                                <td>{{ $comment->user->name ?? 'Anonymous' }}</td>
                                                <td>{{ Str::limit($comment->comment, 100) }}</td>
                                                <td>{{ $comment->created_at->diffForHumans() }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Sidebar -->
                    <div class="col-lg-4">
                        <!-- Stream Controls -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <strong>Stream Controls</strong>
                            </div>
                            <div class="card-body">
                                <div class="d-grid gap-2">
                                    @if($model->obs_status == 0)
                                        <button type="button" class="btn btn-success" onclick="performStreamingAction('{{ route('admin.live-match.start-streaming', $model->id) }}', 'start streaming')">
                                            <i class="fa fa-play"></i> Start Streaming
                                        </button>
                                    @elseif($model->obs_status == 1)
                                        <button type="button" class="btn btn-danger" onclick="performStreamingAction('{{ route('admin.live-match.mark-as-live', $model->id) }}', 'mark as live')">
                                            <i class="fa fa-broadcast-tower"></i> Mark as Live
                                        </button>
                                    @elseif($model->obs_status == 2)
                                        <button type="button" class="btn btn-warning" onclick="performStreamingAction('{{ route('admin.live-match.stop-streaming', $model->id) }}', 'stop streaming')">
                                            <i class="fa fa-stop"></i> Stop Streaming
                                        </button>
                                    @endif

                                    <hr>
                                    
                                    <a href="{{ route('admin.live-match.edit', $model->id) }}" class="btn btn-primary">
                                        <i class="fa fa-edit"></i> Edit Live Match
                                    </a>
                                    
                                    <a href="{{ route('admin.live-match.index') }}" class="btn btn-secondary">
                                        <i class="fa fa-arrow-left"></i> Back to List
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Stats -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <strong>Quick Info</strong>
                            </div>
                            <div class="card-body">
                                <div class="row text-center">
                                    <div class="col-6">
                                        <div class="border-end">
                                            <div class="fs-4 fw-bold text-primary">{{ $model->id }}</div>
                                            <div class="text-muted small">Live Match ID</div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="fs-4 fw-bold text-success">{{ $model->match_id }}</div>
                                        <div class="text-muted small">Match ID</div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row text-center">
                                    <div class="col-6">
                                        <div class="border-end">
                                            <div class="fs-4 fw-bold text-info">{{ $model->comments ? $model->comments->count() : 0 }}</div>
                                            <div class="text-muted small">Comments</div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="fs-4 fw-bold text-warning">{{ $model->status ? 'Active' : 'Inactive' }}</div>
                                        <div class="text-muted small">Status</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Error Log -->
                        @if($recentErrors && count($recentErrors) > 0)
                        <div class="card">
                            <div class="card-header">
                                <strong>Recent Errors</strong>
                            </div>
                            <div class="card-body">
                                @foreach($recentErrors as $error)
                                <div class="alert alert-warning alert-sm">
                                    <small class="text-muted">{{ $error['timestamp'] }}</small><br>
                                    {{ $error['error'] }}
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Update Viewer Count Modal -->
    <div class="modal fade" id="updateViewerModal" tabindex="-1" aria-labelledby="updateViewerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateViewerModalLabel">Update Viewer Count</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="updateViewerForm">
                        <div class="mb-3">
                            <label for="new_viewer_count" class="form-label">New Viewer Count</label>
                            <input type="number" class="form-control" id="new_viewer_count" name="viewer_count" 
                                   value="{{ $model->viewer_count }}" min="0">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="submitViewerUpdate()">Update</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @parent
    <script>
        function copyToClipboard(elementId) {
            const element = document.getElementById(elementId);
            element.select();
            element.setSelectionRange(0, 99999);
            navigator.clipboard.writeText(element.value).then(function() {
                const btn = element.nextElementSibling;
                const originalHTML = btn.innerHTML;
                btn.innerHTML = '<i class="fa fa-check text-success"></i>';
                setTimeout(() => {
                    btn.innerHTML = originalHTML;
                }, 2000);
            });
        }

        function performStreamingAction(url, action) {
            if (confirm(`Are you sure you want to ${action}?`)) {
                axios.post(url, {})
                    .then(response => {
                        if (response.data.success) {
                            location.reload();
                        } else {
                            alert('Error: ' + response.data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while performing the action.');
                    });
            }
        }

        function updateViewerCount() {
            const modal = new bootstrap.Modal(document.getElementById('updateViewerModal'));
            modal.show();
        }

        function submitViewerUpdate() {
            const viewerCount = document.getElementById('new_viewer_count').value;
            
            axios.post('{{ route('admin.live-match.update-viewer-count', $model->id) }}', {
                viewer_count: parseInt(viewerCount)
            })
            .then(response => {
                if (response.data.success) {
                    document.getElementById('viewer-count').textContent = parseInt(viewerCount).toLocaleString();
                    const modal = bootstrap.Modal.getInstance(document.getElementById('updateViewerModal'));
                    modal.hide();
                    
                    // Show success message
                    const alert = document.createElement('div');
                    alert.className = 'alert alert-success alert-dismissible fade show';
                    alert.innerHTML = `
                        ${response.data.message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    `;
                    document.querySelector('.fade-in').prepend(alert);
                } else {
                    alert('Error: ' + response.data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while updating viewer count.');
            });
        }

        // Auto-refresh viewer count every 30 seconds if stream is live
        @if($model->obs_status == 2)
        setInterval(function() {
            // You can implement real-time viewer count updates here
            console.log('Auto-refreshing viewer count...');
        }, 30000);
        @endif
    </script>
@endsection
