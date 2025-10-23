<div class='text-center'>
    <a href="{{ route('admin.user.show', $user->id) }}" class='btn btn-primary' title="View">
        <i class="fa fa-eye"></i>
    </a>
    <a href="{{ route('admin.user.edit', $user->id) }}" class='btn btn-success'>
        <i class="fa fa-pencil"></i>
    </a>
    <a href="#" data-url="{{ route('admin.user.destroy', $user->id) }}" class='btn btn-delete btn-danger'>
        <i class="fa fa-trash"></i>
    </a>
</div>
