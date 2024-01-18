<div class='text-center'>
    <a href='{{route('admin.admin.update', ['id' => $model->id])}}' class='btn btn-success text-white'><i
            class="fa fa-pencil"></i></a>
    <a href="#" data-url='{{route('admin.admin.destroy.delete', ['id' => $model->id])}}'
        class='btn btn-delete btn-danger text-white'><i class="fa fa-trash"></i>
    </a>
</div>