@extends('admin.layout.app')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.live-match.index') }}">Live Match</a></li>
    <li class="breadcrumb-item active"><span>Create</span></li>
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
                                <strong>Create Live Match</strong>
                            </div>
                            <div class="card-body">
                <form action="{{ route('admin.live-match.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    @if(isset($showWarning) && $showWarning)
                    <div class="alert alert-warning">
                        <h5><i class="fa fa-exclamation-triangle"></i> Notice</h5>
                        <p>All active matches already have live streams associated with them. The matches shown below already have live streaming configured.</p>
                        <p>You can still create another live stream for the same match if needed (e.g., for different streaming platforms).</p>
                    </div>
                    @endif
                    
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row mb-3">
                                <label for="match_id" class="col-md-3 col-form-label">Match <span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <select class="form-select" id="match_id" name="match_id" required>
                                        <option value="">Select a match</option>
                                        @foreach($availableMatches as $match)
                                            <option value="{{ $match->id }}" {{ old('match_id') == $match->id ? 'selected' : '' }}>
                                                {{ $match->match_title }} 
                                                @if($match->start_at)
                                                    ({{ \Carbon\Carbon::parse($match->start_at)->format('M d, Y H:i') }})
                                                @endif
                                                @if(isset($showWarning) && $showWarning)
                                                    <span class="text-warning">⚠ Has Live Stream</span>
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                    @if($availableMatches->isEmpty())
                                        <div class="form-text text-danger">No matches available. Please create some matches first.</div>
                                    @else
                                        @error('match_id')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    @endif
                                </div>
                            </div>

                            @if(isset($showWarning) && $showWarning)
                            <div class="row mb-3">
                                <div class="col-md-3"></div>
                                <div class="col-md-9">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="allow_duplicate" name="allow_duplicate">
                                        <label class="form-check-label" for="allow_duplicate">
                                            Allow creating duplicate live stream for the same match
                                        </label>
                                        <div class="form-text">Check this to create multiple live streams for the same match (e.g., for different platforms)</div>
                                    </div>
                                </div>
                            </div>
                            @endif

                                            <div class="row mb-3">
                                                <label for="obs_server_url" class="col-md-3 col-form-label">OBS Server URL</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" id="obs_server_url" name="obs_server_url" 
                                                           value="{{ old('obs_server_url', config('obs.server_url') ?: 'rtmp://' . parse_url(config('app.url'))['host'] . ':1936/live') }}" 
                                                           placeholder="rtmp://{{ parse_url(config('app.url'))['host'] ?? 'localhost' }}:1936/live">
                                                    <div class="form-text">RTMP server URL for OBS streaming</div>
                                                    @error('obs_server_url')
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="obs_stream_key" class="col-md-3 col-form-label">Stream Key</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" id="obs_stream_key" name="obs_stream_key" 
                                                           value="{{ old('obs_stream_key') }}" placeholder="Leave empty to auto-generate">
                                                    <div class="form-text">Leave empty to auto-generate a unique stream key</div>
                                                    @error('obs_stream_key')
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <hr>
                                            <div class="d-flex justify-content-end">
                                                <a href="{{ route('admin.live-match.index') }}" class="btn btn-secondary me-2">Cancel</a>
                                                <button type="submit" class="btn btn-primary">Create Live Match</button>
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
        document.getElementById('quality_preset').addEventListener('change', function() {
            const quality = this.value;
            const presets = {
                'low': { resolution: '854x480', fps: 30, bitrate: 1000 },
                'medium': { resolution: '1280x720', fps: 30, bitrate: 2500 },
                'high': { resolution: '1920x1080', fps: 60, bitrate: 6000 }
            };
            
            if (presets[quality]) {
                document.getElementById('resolution').value = presets[quality].resolution;
                document.getElementById('fps').value = presets[quality].fps;
                document.getElementById('bitrate').value = presets[quality].bitrate;
            }
        });
    </script>
@endsection
