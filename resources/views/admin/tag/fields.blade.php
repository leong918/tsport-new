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
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.5.6/tinymce.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.5.6/jquery.tinymce.min.js"></script>
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
                Swal.fire({
                    title: '{{__("page.tag_added")}}',
                    text: '{{__("page.txt_tag_added")}}',
                    icon: 'success',
                    confirmButtonClass: 'btn btn-success',
                        confirmButtonText: '{{__("page.ok")}}',
                });
                setTimeout(function(){
                    window.location.replace('/admin/tag/index');
                }, 1000);
            })
            .catch(error => {
                Swal.fire({
                    title: '{{__("page.tag_fail_add")}}',
                    text: error.response.data.msg,
                    icon: 'error',
                    confirmButtonClass: 'btn btn-danger',
                    confirmButtonText: '{{__("page.ok")}}',
                });
            });
        });
    });
</script>
@endsection