<div class='text-center'>
    <a href="#" data-url='{{route('admin.email_content.sendMail', ['id' => $model->id])}}' data-subject='{{ $model->subject }}'
        class='btn btn-primary btn-subscriber-mail {{ empty($subscriberMailRunning) || (isset($subscriberMailRunning) && $subscriberMailRunning->end_at) ? '' : 'disabled' }}'>
        <i class="fa-solid fa-paper-plane"></i>
    </a>
    <a href='{{route('admin.email_content.update', ['id' => $model->id])}}' class='btn btn-success'><i
            class="fa fa-pencil"></i></a>
    <a href="#" data-url='{{route('admin.email_content.destroy.delete', ['id' => $model->id])}}'
        class='btn btn-delete btn-danger'><i class="fa fa-trash"></i>
    </a>
</div>