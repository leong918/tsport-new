<!-- Title Field -->
<div class="mb-3">
    <label for="title" class="form-label">Event Title <span class="text-danger">*</span></label>
    <input type="text" 
           class="form-control @error('title') is-invalid @enderror" 
           id="title" 
           name="title" 
           value="{{ old('title', $event->title ?? '') }}" 
           required>
    @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Image Upload Field -->
<div class="mb-3">
    <label for="image" class="form-label">Event Image</label>
    <input type="file" 
           class="form-control @error('image') is-invalid @enderror" 
           id="image" 
           name="image" 
           accept="image/*">
    @error('image')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    
    @if(isset($event) && $event->image)
        <div class="mt-2">
            <label class="form-label">Current Image:</label><br>
            <img src="{{ $event->image_url }}" alt="Current Event Image" class="img-thumbnail" style="max-width: 200px;">
        </div>
    @endif
    
    <div class="form-text">Supported formats: JPEG, PNG, JPG, GIF, WebP. Max size: 2MB.</div>
</div>

<!-- Status Field -->
<div class="mb-3">
    <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
    <select class="form-select @error('status') is-invalid @enderror" 
            id="status" 
            name="status" 
            required>
        <option value="">Select Status</option>
        <option value="upcoming" {{ old('status', $event->status ?? '') == 'upcoming' ? 'selected' : '' }}>
            Upcoming
        </option>
        <option value="active" {{ old('status', $event->status ?? '') == 'active' ? 'selected' : '' }}>
            Active
        </option>
        <option value="ended" {{ old('status', $event->status ?? '') == 'ended' ? 'selected' : '' }}>
            Ended
        </option>
    </select>
    @error('status')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Event Schedule Time -->
<div class="mb-3">
    <label for="daterange" class="form-label">Event Schedule</label>
    <div class="input-group">
        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
        <input type="text" class="form-control" id="daterange" name="daterange" 
               autocomplete="off" placeholder="Select start and end time" />
    </div>
    <input type="hidden" name="start_time" id="start_time" value="{{ old('start_time', isset($event) && $event->start_time ? $event->start_time->format('Y-m-d H:i:s') : '') }}">
    <input type="hidden" name="end_time" id="end_time" value="{{ old('end_time', isset($event) && $event->end_time ? $event->end_time->format('Y-m-d H:i:s') : '') }}">
    <div class="form-text">Select start and end time for the event</div>
    @error('start_time')
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
    @error('end_time')
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>

<!-- Is Active Field -->
<div class="mb-3">
    <div class="form-check">
        <input type="checkbox" 
               class="form-check-input @error('is_active') is-invalid @enderror" 
               id="is_active" 
               name="is_active" 
               value="1" 
               {{ old('is_active', $event->is_active ?? true) ? 'checked' : '' }}>
        <label class="form-check-label" for="is_active">
            Active Event
        </label>
        @error('is_active')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-text">Inactive events won't be displayed on the website.</div>
</div>
