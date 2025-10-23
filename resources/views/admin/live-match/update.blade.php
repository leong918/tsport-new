@extends('admin.layout.app')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.live-match.index') }}">Live Match</a></li>
    <li class="breadcrumb-item active"><span>Edit</span></li>
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
                                <strong>Edit Live Match</strong>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.live-match.update', $model->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="row mb-3">
                                                <label for="match_id" class="col-md-3 col-form-label">Match <span class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <select class="form-select" id="match_id" name="match_id" required>
                                                        <option value="">Select a match</option>
                                                        @foreach($availableMatches as $match)
                                                            <option value="{{ $match->id }}" {{ old('match_id', $model->match_id) == $match->id ? 'selected' : '' }}>
                                                                {{ $match->match_title }} 
                                                                @if($match->start_at)
                                                                    ({{ \Carbon\Carbon::parse($match->start_at)->format('M d, Y H:i') }})
                                                                @endif
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('match_id')
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="thumbnail" class="col-md-3 col-form-label">Thumbnail</label>
                                                <div class="col-md-9">
                                                    <input type="file" class="form-control" id="thumbnail" name="thumbnail" accept="image/*">
                                                    <div class="form-text">Thumbnail image displayed before live stream starts (16:9 ratio recommended)</div>
                                                    @error('thumbnail')
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                    
                                                    @if($model->thumbnail)
                                                        <div class="mt-3">
                                                            <label>Current Thumbnail</label>
                                                            <div class="thumbnail-preview-container" style="max-width: 400px;">
                                                                <div style="position: relative; width: 100%; padding-bottom: 56.25%; background: #f0f0f0; overflow: hidden; border-radius: 4px;">
                                                                    <img src="{{ $model->thumbnail_url }}" alt="Current thumbnail" 
                                                                         style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    
                                                    <div id="thumbnail-preview" class="mt-3" style="display: none;">
                                                        <label>New Preview</label>
                                                        <div class="thumbnail-preview-container" style="max-width: 400px;">
                                                            <div style="position: relative; width: 100%; padding-bottom: 56.25%; background: #f0f0f0; overflow: hidden; border-radius: 4px;">
                                                                <img id="thumbnail-preview-img" src="" alt="Thumbnail preview" 
                                                                     style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="obs_server_url" class="col-md-3 col-form-label">OBS Server URL</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" id="obs_server_url" name="obs_server_url" 
                                                           value="{{ old('obs_server_url', $model->obs_server_url) }}" 
                                                           placeholder="rtmp://localhost:1935/live">
                                                    <div class="form-text">RTMP server URL for OBS streaming</div>
                                                    @error('obs_server_url')
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="rtmp_url" class="col-md-3 col-form-label">Stream Key & RTMP URL</label>
                                                <div class="col-md-9">
                                                    <div class="mb-2">
                                                        <label class="form-label small">Stream Key</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" id="obs_stream_key" 
                                                                   value="{{ $model->obs_stream_key }}" readonly>
                                                            <button class="btn btn-outline-secondary" type="button" onclick="copyToClipboard('obs_stream_key')">
                                                                <i class="fa fa-copy"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <label class="form-label small">Complete RTMP URL</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" id="rtmp_url" 
                                                                   value="{{ $model->rtmp_url ?: $model->generateRtmpUrl() }}" readonly>
                                                            <button class="btn btn-outline-secondary" type="button" onclick="copyToClipboard('rtmp_url')">
                                                                <i class="fa fa-copy"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="form-text">Stream key is auto-generated and cannot be modified</div>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="viewer_count" class="col-md-3 col-form-label">Viewer Count</label>
                                                <div class="col-md-9">
                                                    <input type="number" class="form-control" id="viewer_count" name="viewer_count" 
                                                           value="{{ old('viewer_count', $model->viewer_count) }}" min="0">
                                                    <div class="form-text">Current number of viewers</div>
                                                    @error('viewer_count')
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <!-- Stream Status Card -->
                                            <div class="card mb-3">
                                                <div class="card-header">
                                                    <strong>Stream Status</strong>
                                                </div>
                                                <div class="card-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Current Status</label>
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

                                                    @if($model->stream_started_at)
                                                    <div class="mb-3">
                                                        <label class="form-label">Stream Started</label>
                                                        <div class="text-muted">{{ $model->stream_started_at->format('M d, Y H:i:s') }}</div>
                                                        <div class="text-muted small">{{ $model->stream_started_at->diffForHumans() }}</div>
                                                    </div>
                                                    @endif

                                                    @if($model->stream_ended_at)
                                                    <div class="mb-3">
                                                        <label class="form-label">Stream Ended</label>
                                                        <div class="text-muted">{{ $model->stream_ended_at->format('M d, Y H:i:s') }}</div>
                                                    </div>
                                                    @endif

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
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <hr>
                                            <div class="d-flex justify-content-end">
                                                <a href="{{ route('admin.live-match.index') }}" class="btn btn-secondary me-2">Cancel</a>
                                                <button type="submit" class="btn btn-primary">Update Live Match</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
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
        // Thumbnail preview
        document.getElementById('thumbnail').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('thumbnail-preview-img').src = e.target.result;
                    document.getElementById('thumbnail-preview').style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                document.getElementById('thumbnail-preview').style.display = 'none';
            }
        });

        function copyToClipboard(elementId) {
            const element = document.getElementById(elementId);
            element.select();
            element.setSelectionRange(0, 99999); // For mobile devices
            navigator.clipboard.writeText(element.value).then(function() {
                // Show success message
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
    </script>
@endsection
