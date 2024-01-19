<span data-url='{{ $route }}'
    class='{{ auth('admin')->user()->id !== $model->id ? 'btn-status' : ''}} badge bg-{{ ($status ? 'success' : 'danger') }}'>
    {{ ( $status ? 'Active' : 'Inactive') }} 
</span>