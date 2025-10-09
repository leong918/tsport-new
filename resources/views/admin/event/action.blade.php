@if(!$event->deleted_at)
    <!-- Active Event Actions -->
    <div class="btn-group" role="group">
        <a href="{{ route('admin.event.show', $event->id) }}" class="btn btn-sm btn-info" title="View">
            <i class="fa fa-eye"></i>
        </a>
        <a href="{{ route('admin.event.edit', $event->id) }}" class="btn btn-sm btn-warning" title="Edit">
            <i class="fa fa-edit"></i>
        </a>
        <button type="button" class="btn btn-sm btn-secondary toggle-status" 
                data-url="{{ route('admin.event.toggle-status', $event->id) }}" 
                title="Toggle Active Status">
            <i class="fa fa-{{ $event->is_active ? 'pause' : 'play' }}"></i>
        </button>
        <button type="button" class="btn btn-sm btn-danger delete-btn" 
                data-url="{{ route('admin.event.destroy', $event->id) }}" 
                title="Delete">
            <i class="fa fa-trash"></i>
        </button>
    </div>
@else
    <!-- Deleted Event Actions -->
    <div class="btn-group" role="group">
        <a href="{{ route('admin.event.show', $event->id) }}" class="btn btn-sm btn-info" title="View">
            <i class="fa fa-eye"></i>
        </a>
        <button type="button" class="btn btn-sm btn-success restore-btn" 
                data-url="{{ route('admin.event.restore', $event->id) }}" 
                title="Restore">
            <i class="fa fa-undo"></i>
        </button>
        <button type="button" class="btn btn-sm btn-danger force-delete-btn" 
                data-url="{{ route('admin.event.force-delete', $event->id) }}" 
                title="Permanently Delete">
            <i class="fa fa-trash-alt"></i>
        </button>
    </div>
@endif
