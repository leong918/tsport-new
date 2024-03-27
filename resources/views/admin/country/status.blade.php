<span data-url='{{ $route }}'
    class='btn-status' badge bg-{{ ($status ? 'success' : 'danger') }}'>
    {{ ( $status ? 'Active' : 'Inactive') }} 
</span>