<x-alert />

<div class="row mb-5">
    <div class="col-md-6">
        <div class="mb-3">
            {{ html()->label('Name') }}
            {{ html()->text('name')->placeholder('Enter name')->class('form-control')->required() }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            {{ html()->label('Status') }}
            {{ html()->select('status')->options(renderSelect(Tag::STATUS))->class('form-control')->required() }}
        </div>
    </div>
</div>

@section('script')
@parent
<script src="{{ asset('assets/admin/js/tinymce.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/jquery.tinymce.min.js') }}"></script>
<script>
    $(document).ready(function() { 
        $("#tag").submit(function(e) {
            e.preventDefault();

            tinymce.triggerSave();

            var url = $(this).attr('action');

            let formData = new FormData(this);

            $(".form-control-file").each(function() {
                formData.append($(this).attr("name"), $(this)[0].files[0]);
            })

            axios({
                method: "post",
                url: url,
                data: formData,
                headers: { "Content-Type": "multipart/form-data" },
            })
            .then(response => {
                swal.fire({
                    title: 'Success',
                    text: 'Tag Added Successfully',
                    icon: 'success',
                    confirmButtonClass: 'btn btn-success',
                    confirmButtonText: 'OK',
                });
                setTimeout(function(){
                    window.location.replace('/admin/tag/index');
                }, 1000);
            })
            .catch(error => {
                swal.fire({
                    title: 'Failed',
                    text: error.response.data.msg,
                    icon: 'error',
                    confirmButtonClass: 'btn btn-danger',
                    confirmButtonText: 'OK',
                });
            });
        });
    });
</script>
@endsection