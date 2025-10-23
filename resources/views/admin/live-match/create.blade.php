@extends('admin.layout.app')

@section('style')
    @parent
    <link rel="stylesheet" href="{{ asset('assets/admin/css/daterangepicker.css') }}" />
    <style>
        /* Daterangepicker color enhancements */
        .daterangepicker {
            z-index: 9999 !important;
        }
        
        .daterangepicker .calendar-table {
            background-color: white !important;
        }
        
        .daterangepicker td.active, 
        .daterangepicker td.active:hover,
        .daterangepicker td.start-date,
        .daterangepicker td.end-date {
            background-color: #0d6efd !important;
            border-color: #0d6efd !important;
            color: #ffffff !important;
            font-weight: 600 !important;
        }
        
        .daterangepicker td.in-range {
            background-color: #cfe2ff !important;
            border-color: transparent !important;
            color: #000000 !important;
        }
        
        .daterangepicker td.available:hover {
            background-color: #f8f9fa !important;
            border-color: #dee2e6 !important;
            color: #000000 !important;
        }
        
        .daterangepicker td.off {
            background-color: #ffffff !important;
            color: #cccccc !important;
        }
        
        .daterangepicker th.month {
            color: #000000 !important;
            font-weight: 600 !important;
        }
        
        .daterangepicker .calendar-table th {
            background-color: #f8f9fa !important;
            color: #6c757d !important;
            font-weight: 600 !important;
            border: none !important;
        }
        
        .daterangepicker .calendar-table td {
            color: #000000 !important;
        }
        
        .daterangepicker select.hourselect, 
        .daterangepicker select.minuteselect, 
        .daterangepicker select.secondselect {
            background-color: #f8f9fa !important;
            border: 1px solid #ced4da !important;
            color: #000000 !important;
        }
        
        .daterangepicker .drp-buttons .btn {
            padding: 6px 12px !important;
            font-size: 14px !important;
        }
        
        .daterangepicker .drp-buttons .btn-primary,
        .daterangepicker .drp-buttons button.applyBtn {
            background-color: #0d6efd !important;
            border-color: #0d6efd !important;
            color: #ffffff !important;
        }
        
        .daterangepicker .drp-buttons .btn-default,
        .daterangepicker .drp-buttons button.cancelBtn {
            background-color: #6c757d !important;
            border-color: #6c757d !important;
            color: #ffffff !important;
        }
    </style>
@endsection

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
                                <form action="{{ route('admin.live-match.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf

                                    @if (isset($showWarning) && $showWarning)
                                        <div class="alert alert-warning">
                                            <h5><i class="fa fa-exclamation-triangle"></i> Notice</h5>
                                            <p>All active matches already have live streams associated with them. The
                                                matches shown below already have live streaming configured.</p>
                                            <p>You can still create another live stream for the same match if needed (e.g.,
                                                for different streaming platforms).</p>
                                        </div>
                                    @endif

                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="row mb-3">
                                                <label for="match_id" class="col-md-3 col-form-label">Match <span
                                                        class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <select class="form-select" id="match_id" name="match_id" required>
                                                        <option value="">Select a match</option>
                                                        @foreach ($availableMatches as $match)
                                                            <option value="{{ $match->id }}"
                                                                {{ old('match_id') == $match->id ? 'selected' : '' }}>
                                                                {{ $match->match_title }}
                                                                @if ($match->start_at)
                                                                    ({{ \Carbon\Carbon::parse($match->start_at)->format('M d, Y H:i') }})
                                                                @endif
                                                                @if (isset($showWarning) && $showWarning)
                                                                    <span class="text-warning">⚠ Has Live Stream</span>
                                                                @endif
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @if ($availableMatches->isEmpty())
                                                        <div class="form-text text-danger">No matches available. Please
                                                            create some matches first.</div>
                                                    @else
                                                        @error('match_id')
                                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                                        @enderror
                                                    @endif
                                                </div>
                                            </div>

                                            @if (isset($showWarning) && $showWarning)
                                                <div class="row mb-3">
                                                    <div class="col-md-3"></div>
                                                    <div class="col-md-9">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="1"
                                                                id="allow_duplicate" name="allow_duplicate">
                                                            <label class="form-check-label" for="allow_duplicate">
                                                                Allow creating duplicate live stream for the same match
                                                            </label>
                                                            <div class="form-text">Check this to create multiple live
                                                                streams for the same match (e.g., for different platforms)
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="row mb-3">
                                                <label for="daterange" class="col-md-3 col-form-label">Schedule Time</label>
                                                <div class="col-md-9">
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                        <input type="text" class="form-control" id="daterange" name="daterange" 
                                                               autocomplete="off" placeholder="Select start and end time" />
                                                    </div>
                                                    <input type="hidden" name="start_at" id="start_at" value="{{ old('start_at') }}">
                                                    <input type="hidden" name="end_at" id="end_at" value="{{ old('end_at') }}">
                                                    <div class="form-text">Select start and end time for the live match</div>
                                                    @error('start_at')
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                    @error('end_at')
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="thumbnail" class="col-md-3 col-form-label">Thumbnail</label>
                                                <div class="col-md-9">
                                                    <input type="file" class="form-control" id="thumbnail"
                                                        name="thumbnail" accept="image/*">
                                                    <div class="form-text">Thumbnail image displayed before live stream
                                                        starts (16:9 ratio recommended)</div>
                                                    @error('thumbnail')
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                    <div id="thumbnail-preview" class="mt-3" style="display: none;">
                                                        <label>Preview</label>
                                                        <div class="thumbnail-preview-container" style="max-width: 400px;">
                                                            <div
                                                                style="position: relative; width: 100%; padding-bottom: 56.25%; background: #f0f0f0; overflow: hidden; border-radius: 4px;">
                                                                <img id="thumbnail-preview-img" src=""
                                                                    alt="Thumbnail preview"
                                                                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="obs_server_url" class="col-md-3 col-form-label">OBS Server
                                                    URL</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" id="obs_server_url"
                                                        name="obs_server_url"
                                                        value="{{ old('obs_server_url', config('obs.server_url') ?: 'rtmp://' . parse_url(config('app.url'))['host'] . ':1936/live') }}"
                                                        placeholder="rtmp://{{ parse_url(config('app.url'))['host'] ?? 'localhost' }}:1936/live">
                                                    <div class="form-text">RTMP server URL for OBS streaming (Stream key
                                                        will be auto-generated)</div>
                                                    @error('obs_server_url')
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
                                                <a href="{{ route('admin.live-match.index') }}"
                                                    class="btn btn-secondary me-2">Cancel</a>
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
    <script src="{{ asset('assets/admin/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/daterangepicker.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Get old values if exist
            var startDate = $('#start_at').val() ? moment($('#start_at').val()) : moment();
            var endDate = $('#end_at').val() ? moment($('#end_at').val()) : moment().add(1, 'hours');

            // Initialize daterangepicker
            $('#daterange').daterangepicker({
                timePicker: true,
                timePicker24Hour: true,
                timePickerSeconds: true,
                startDate: startDate,
                endDate: endDate,
                locale: {
                    format: 'YYYY-MM-DD HH:mm:ss',
                    separator: ' to ',
                    applyLabel: 'Apply',
                    cancelLabel: 'Cancel',
                    fromLabel: 'From',
                    toLabel: 'To',
                    customRangeLabel: 'Custom',
                    weekLabel: 'W',
                    daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                    monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    firstDay: 1
                }
            }, function(start, end, label) {
                // Update hidden fields when date range is selected
                $('#start_at').val(start.format('YYYY-MM-DD HH:mm:ss'));
                $('#end_at').val(end.format('YYYY-MM-DD HH:mm:ss'));
            });

            // Set initial values if they exist
            if ($('#start_at').val() && $('#end_at').val()) {
                var initialStart = moment($('#start_at').val());
                var initialEnd = moment($('#end_at').val());
                $('#daterange').val(initialStart.format('YYYY-MM-DD HH:mm:ss') + ' to ' + initialEnd.format('YYYY-MM-DD HH:mm:ss'));
            }
        });

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
    </script>
@endsection
