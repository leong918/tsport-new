<x-alert />

<div class="row">
    <div class="col-md-12">
        <div class="mb-3 col-md-6">
            {{ html()->label('Email Subject') }}
            {{ html()->text('subject')->placeholder('Enter email subject')->class('form-control')->required() }}
        </div>
    </div>
    <div class="col-md-12">
        <div class="mb-3">
            {{ html()->label('Email Content') }}
            {{ html()->textarea('content')->rows(15)->class('form-control wysiwyg') }}
        </div>
    </div>
</div>

@section('script')
@parent
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.5.6/tinymce.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.5.6/jquery.tinymce.min.js"></script>
<script>
    $(document).ready(function() { 
        var editor_config = {
            path_absolute : "{{ config('app.url') .'/' }}",
            selector: "textarea.wysiwyg",
            plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | forecolor backcolor | fontsizeselect",
            fontsize_formats: '8pt 10pt 12pt 14pt 16pt 18pt 24pt 36pt 48pt',
            relative_urls: false,
            image_class_list: [
                {title: 'img-fluid', value: 'img-fluid'},
            ],
            file_browser_callback : function(field_name, url, type, win) {
                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

                var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
                if (type == 'image') {
                    cmsURL = cmsURL + "&type=Images";
                } else {
                    cmsURL = cmsURL + "&type=Files";
                }

                tinyMCE.activeEditor.windowManager.open({
                    file : cmsURL,
                    title : 'Filemanager',
                    width : x * 0.8,
                    height : y * 0.8,
                    resizable : "yes",
                    close_previous : "no"
                });
            },
            image_title: true,
            automatic_uploads: true,
            file_picker_types: 'image',
            file_picker_callback: function(cb, value, meta) {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');
                input.onchange = function() {
                    var file = this.files[0];

                    var reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onload = function () {
                        var id = 'blobid' + (new Date()).getTime();
                        var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                        var base64 = reader.result.split(',')[1];
                        var blobInfo = blobCache.create(id, file, base64);
                        blobCache.add(blobInfo);
                        cb(blobInfo.blobUri(), { title: file.name });
                    };
                };
                input.click();
            }
        };

        tinymce.init(editor_config);

        $("#email_content").submit(function(e) {
            e.preventDefault();

            tinymce.triggerSave();

            var url = $(this).attr('action');

            let formData = new FormData(this);

            axios({
                method: "post",
                url: url,
                data: formData,
            })
            .then(response => {
                swal.fire({
                    title: 'Success',
                    text: 'Email Added Successfully',
                    icon: 'success',
                    confirmButtonClass: 'btn btn-success',
                    confirmButtonText: 'OK',
                });
                setTimeout(function(){
                    window.location.replace('/admin/email_content/index');
                }, 1000);
            })
            .catch(error => {
                let errorMessage = '';
                if (typeof error.response.data.msg === 'object') {
                    Object.keys(error.response.data.msg).forEach(key => {
                            errorMessage += `${error.response.data.msg[key]}<br>`;
                    });
                } else if(error.response.data.msg){
                    errorMessage = error.response.data.msg;
                } else if(error.response.data.message){
                    errorMessage = error.response.data.message;
                }

                swal.fire({
                    title: 'Failed',
                    html: errorMessage,
                    icon: 'error',
                    confirmButtonClass: 'btn btn-danger',
                    confirmButtonText: 'OK',
                });
            });
        });
    });
</script>
@endsection