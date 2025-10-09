@extends('admin.layout.app')

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
    <script>
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
        
        // Auto-calculate end time when start time is set
        document.getElementById('start_time').addEventListener('change', function(e) {
            const startTime = new Date(e.target.value);
            const endTimeInput = document.getElementById('end_time');
            
            if (startTime && !endTimeInput.value) {
                // Default to 2 hours after start time
                const endTime = new Date(startTime.getTime() + (2 * 60 * 60 * 1000));
                endTimeInput.value = endTime.toISOString().slice(0, 16);
            }
        });
    </script>
@endsection
