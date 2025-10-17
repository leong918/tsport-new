<div class="d-flex gap-1">
    <!-- View Details Button -->
    <a href="{{ route('admin.live-match.show', $model->id) }}" class="btn btn-info btn-sm" title="View Details">
        <i class="fa fa-eye"></i>
    </a>
    
    <!-- Edit Button -->
    <a href="{{ route('admin.live-match.edit', $model->id) }}" class="btn btn-primary btn-sm" title="Edit">
        <i class="fa fa-edit"></i>
    </a>
    
    <!-- Streaming Action Button -->
    @if($model->obs_status == 0)
        <button class="btn btn-success btn-sm btn-start-streaming" data-url="{{ route('admin.live-match.start-streaming', $model->id) }}" title="Start Streaming">
            <i class="fa fa-play"></i>
        </button>
    @elseif($model->obs_status == 1)
        <button class="btn btn-warning btn-sm btn-mark-live" data-url="{{ route('admin.live-match.mark-as-live', $model->id) }}" title="Mark as Live">
            <i class="fa fa-broadcast-tower"></i>
        </button>
    @elseif($model->obs_status == 2)
        <button class="btn btn-secondary btn-sm btn-stop-streaming" data-url="{{ route('admin.live-match.stop-streaming', $model->id) }}" title="Stop Streaming">
            <i class="fa fa-stop"></i>
        </button>
    @endif
    
    <!-- Delete Button -->
    <button class="btn btn-danger btn-sm btn-delete" data-url="{{ route('admin.live-match.destroy', $model->id) }}" title="Delete">
        <i class="fa fa-trash"></i>
    </button>
</div>
