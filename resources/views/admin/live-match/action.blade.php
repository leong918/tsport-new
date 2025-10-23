<div class='text-center' style="white-space: nowrap;">
    <a href="{{ route('admin.live-match.show', $model->id) }}" class='btn btn-primary' title="View">
        <i class="fa fa-eye"></i>
    </a>
    <a href="{{ route('admin.live-match.edit', $model->id) }}" class='btn btn-success'>
        <i class="fa fa-pencil"></i>
    </a>
    @if($model->obs_status == 0)
        <button class="btn btn-primary btn-start-streaming" data-url="{{ route('admin.live-match.start-streaming', $model->id) }}" title="Start Streaming">
            <i class="fa fa-play"></i>
        </button>
    @elseif($model->obs_status == 1)
        <button class="btn btn-warning btn-mark-live" data-url="{{ route('admin.live-match.mark-as-live', $model->id) }}" title="Mark as Live">
            <i class="fa fa-broadcast-tower"></i>
        </button>
    @elseif($model->obs_status == 2)
        <button class="btn btn-secondary btn-stop-streaming" data-url="{{ route('admin.live-match.stop-streaming', $model->id) }}" title="Stop Streaming">
            <i class="fa fa-stop"></i>
        </button>
    @endif
    <a href="#" data-url="{{ route('admin.live-match.destroy', $model->id) }}" class='btn btn-delete btn-danger'>
        <i class="fa fa-trash"></i>
    </a>
</div>
