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
    <li class="breadcrumb-item"><a href="{{ route('admin.event.index') }}">Events</a></li>
    <li class="breadcrumb-item active"><span>Create Event</span></li>
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
                                <strong>Create New Event</strong>
                                <a href="{{ route('admin.event.index') }}" class="btn btn-secondary float-end">
                                    <i class="fa fa-arrow-left"></i> Back to List
                                </a>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.event.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    
                                    @include('admin.event.fields')
                                    
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <a href="{{ route('admin.event.index') }}" class="btn btn-secondary me-md-2">
                                            Cancel
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-save"></i> Create Event
                                        </button>
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
            // Initialize daterangepicker
            $('#daterange').daterangepicker({
                timePicker: true,
                timePicker24Hour: true,
                timePickerSeconds: true,
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
                $('#start_time').val(start.format('YYYY-MM-DD HH:mm:ss'));
                $('#end_time').val(end.format('YYYY-MM-DD HH:mm:ss'));
            });

            // Set initial value if dates exist (for validation errors)
            @if(old('start_time') && old('end_time'))
                var oldStart = moment('{{ old('start_time') }}');
                var oldEnd = moment('{{ old('end_time') }}');
                $('#daterange').data('daterangepicker').setStartDate(oldStart);
                $('#daterange').data('daterangepicker').setEndDate(oldEnd);
                $('#daterange').val(oldStart.format('YYYY-MM-DD HH:mm:ss') + ' to ' + oldEnd.format('YYYY-MM-DD HH:mm:ss'));
            @endif
        });

        // Image preview functionality
        document.getElementById('image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Remove existing preview if any
                    const existingPreview = document.getElementById('image-preview');
                    if (existingPreview) {
                        existingPreview.remove();
                    }
                    
                    // Create new preview
                    const preview = document.createElement('div');
                    preview.id = 'image-preview';
                    preview.className = 'mt-2';
                    preview.innerHTML = `
                        <label class="form-label">Preview:</label><br>
                        <img src="${e.target.result}" alt="Preview" class="img-thumbnail" style="max-width: 200px;">
                    `;
                    
                    // Insert after the file input
                    e.target.parentNode.insertBefore(preview, e.target.nextSibling);
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
