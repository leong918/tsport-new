<div class='text-center'>
    <a href='{{route('admin.admin.update', ['id' => $model->id])}}' class='btn btn-success'><i
            class="fa fa-pencil"></i></a>
    @if(auth('admin')->user()->id !== $model->id)
    <a href="#" data-url='{{route('admin.admin.destroy.delete', ['id' => $model->id])}}'
        class='btn btn-delete btn-danger'><i class="fa fa-trash"></i>
    </a>
    @endif
</div>