@extends('admin.layout.app')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.event.index') }}">Events</a></li>
    <li class="breadcrumb-item active"><span>Edit Event</span></li>
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
                                <strong>Edit Event: {{ $event->title }}</strong>
                                <div class="float-end">
                                    <a href="{{ route('admin.event.show', $event->id) }}" class="btn btn-info me-2">
                                        <i class="fa fa-eye"></i> View
                                    </a>
                                    <a href="{{ route('admin.event.index') }}" class="btn btn-secondary">
                                        <i class="fa fa-arrow-left"></i> Back to List
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.event.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    
                                    @include('admin.event.fields')
                                    
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <a href="{{ route('admin.event.index') }}" class="btn btn-secondary me-md-2">
                                            Cancel
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-save"></i> Update Event
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
                        <label class="form-label">New Preview:</label><br>
                        <img src="${e.target.result}" alt="Preview" class="img-thumbnail" style="max-width: 200px;">
                    `;
                    
                    // Insert after the current image display
                    const currentImageDiv = document.querySelector('.mt-2');
                    if (currentImageDiv) {
                        currentImageDiv.parentNode.insertBefore(preview, currentImageDiv.nextSibling);
                    } else {
                        e.target.parentNode.insertBefore(preview, e.target.nextSibling);
                    }
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
