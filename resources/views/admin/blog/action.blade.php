<div class='text-center'>
    <button type="button" class="btn btn-primary btn-comment" data-bs-toggle="modal" data-bs-target="#commentModal" data-id="{{ $model->id }}">
        <i class="fa fa-comment"></i>
      </button>
    <a href='{{route('admin.blog.update', ['id' => $model->id])}}' class='btn btn-success'><i
            class="fa fa-pencil"></i></a>
    <a href="#" data-url='{{route('admin.blog.destroy.delete', ['id' => $model->id])}}'
        class='btn btn-delete btn-danger'><i class="fa fa-trash"></i>
    </a>
</div>