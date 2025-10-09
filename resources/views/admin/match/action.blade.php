<div class='text-center'>
    <a href="{{ route('admin.match.update', ['id' => $model->id]) }}" class='btn btn-success'><i
            class="fa fa-pencil"></i></a>
    <a href="#" data-url="{{ route('admin.match.destroy.delete', ['id' => $model->id]) }}"
        class='btn btn-delete btn-danger'><i class="fa fa-trash"></i>
    </a>
</div>
