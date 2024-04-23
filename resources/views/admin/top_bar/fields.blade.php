<x-alert />

<div class="row mb-5">
    <div class="col-md-12">
        <div class="mb-3">
            {{ html()->label('Content') }}
            {{ html()->textarea('content')->value(isset($model) ? $model->content : "")->class('form-control wysiwyg') }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            {{ html()->label('Name') }}
            {{ html()->text('name')->placeholder('Enter name')->class('form-control name')->required() }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            {{ html()->label('Status') }}
            {{ html()->select('status')->options(renderSelect(TopBar::STATUS))->class('form-control')->required() }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            {{ html()->label('Background Colour') }}
            <input type="color" name="background_color" class="form-control form-control-color background_color" value="{{ isset($model) ? $model->background_color : '#FFFFFF' }}">
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
            },
            setup: function(editor) {
                editor.on('input', function(e) {
                    $('#output').html(tinymce.activeEditor.getContent());
                });
            }
        };

        tinymce.init(editor_config);

        @if(isset($model))
            $('.output').css('background-color', '{{ $model->background_color }}');
        @endif

        $('.background_color').on('change, input', function () {
            $('.output').css('background-color', $(this).val());
        });

        $("#top_bar").submit(function(e) {
            e.preventDefault();

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
                    text: 'Top Bar Added!',
                    icon: 'success',
                    confirmButtonClass: 'btn btn-success',
                        confirmButtonText: 'OK',
                });
                setTimeout(function(){
                    window.location.replace('/admin/top_bar/index');
                }, 1000);
            })
            .catch(error => {
                swal.fire({
                    title: 'Fail',
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