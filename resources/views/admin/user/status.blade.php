<span data-url='{{ $route }}'
    class='btn-status badge bg-{{ ($status ? 'success' : 'danger') }}' style="cursor: pointer;">
    {{ ( $status ? 'Active' : 'Inactive') }} 
</span>
