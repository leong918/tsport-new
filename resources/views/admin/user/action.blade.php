<div class='text-center'>
    @if(!$model->email_verified_at && $model->status == 0)
        <a href="#" data-url='{{route('admin.verification.sendVerificationViaEmail', ['id' => $model->id])}}'
            class='btn btn-primary btn-mail'>
            <i class="fa fa-envelope"></i>
        </a>
    @endif
    <a href='{{route('admin.user.update', ['id' => $model->id])}}' class='btn btn-success'><i
            class="fa fa-pencil"></i></a>
    <a href="#" data-url='{{route('admin.user.destroy.delete', ['id' => $model->id])}}'
        class='btn btn-delete btn-danger'><i class="fa fa-trash"></i>
    </a>

</div>