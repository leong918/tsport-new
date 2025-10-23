@if(!$event->deleted_at)
    <!-- Active Event Actions -->
    <div class='text-center'>
        <a href="{{ route('admin.event.show', $event->id) }}" class='btn btn-primary' title="View">
            <i class="fa fa-eye"></i>
        </a>
        <a href="{{ route('admin.event.edit', $event->id) }}" class='btn btn-success'>
            <i class="fa fa-pencil"></i>
        </a>
        <a href="#" data-url="{{ route('admin.event.destroy', $event->id) }}" class='btn btn-delete btn-danger'>
            <i class="fa fa-trash"></i>
        </a>
    </div>
@else
    <!-- Deleted Event Actions -->
    <div class='text-center'>
        <button type="button" class="btn btn-success restore-btn" 
                data-url="{{ route('admin.event.restore', $event->id) }}" 
                title="Restore">
            <i class="fa fa-undo"></i>
        </button>
        <button type="button" class="btn btn-danger force-delete-btn" 
                data-url="{{ route('admin.event.force-delete', $event->id) }}" 
                title="Permanently Delete">
            <i class="fa fa-trash-alt"></i>
        </button>
    </div>
@endif
