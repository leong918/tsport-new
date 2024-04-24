@extends('admin.layout.app')

@section('content')
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <x-alert />
                <div class="row">
                    {{ html()->model($setting_model)->form('POST', route('admin.setting.updateAbout.post'))->acceptsFiles()->id('about_index')->open() }}
                    <div class="col-sm-12">
                        <div class="card mb-3">
                            <div class="card-header"><strong>About</strong></div>
                            <div class="card-body table-listing table-responsive">
                                <div class="row product-field-wrapper">
                                    <div class="col-md-6">
                                        {{ html()->label('Facebook Text') }}
                                        {{ html()->text('facebook_text')->placeholder('Enter Facebook text')->class('form-control')->required() }}
                                    </div>
                                    <div class="col-md-6">
                                        {{ html()->label('Facebook URL') }}
                                        {{ html()->text('facebook_url')->placeholder('Enter Facebook url')->class('form-control')->required() }}
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        {{ html()->label('Instagram Text') }}
                                        {{ html()->text('instagram_text')->placeholder('Enter Instagram text')->class('form-control')->required() }}
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        {{ html()->label('Instagram URL') }}
                                        {{ html()->text('instagram_url')->placeholder('Enter Instagram url')->class('form-control')->required() }}
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        {{ html()->label('Banner') }}
                                        {{ html()->file('about_banner')->accept('image/')->class('form-control')->required() }}
                                        <br />
                                        <img class="img-fluid" {{ isset($setting_model) ? 'src=' . $setting_model['about_banner'] : '' }} />
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        {{ html()->label('Right Image') }}
                                        {{ html()->file('about_right_image')->accept('image/')->class('form-control')->required() }}
                                        <br />
                                        <img class="img-fluid" {{ isset($setting_model) ? 'src=' . $setting_model['about_right_image'] : '' }} />
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        {{ html()->label('About Content') }}
                                        {{ html()->textarea('about_content')->value(isset($setting_model) ? $setting_model['about_content'] : '')->class('form-control wysiwyg') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="my-3 float-end">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                    {{ html()->form()->close() }}
                </div>
            </div>
        </div>
    </main>
@endsection

@section('script')
    @parent
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.5.6/tinymce.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.5.6/jquery.tinymce.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>

    <script>
        $(document).ready(function() {
            var editor_config = {
                path_absolute: "{{ config('app.url') . '/' }}",
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
                image_class_list: [{
                    title: 'img-fluid',
                    value: 'img-fluid'
                }, ],
                file_browser_callback: function(field_name, url, type, win) {
                    var x = window.innerWidth || document.documentElement.clientWidth || document
                        .getElementsByTagName('body')[0].clientWidth;
                    var y = window.innerHeight || document.documentElement.clientHeight || document
                        .getElementsByTagName('body')[0].clientHeight;

                    var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' +
                        field_name;
                    if (type == 'image') {
                        cmsURL = cmsURL + "&type=Images";
                    } else {
                        cmsURL = cmsURL + "&type=Files";
                    }

                    tinyMCE.activeEditor.windowManager.open({
                        file: cmsURL,
                        title: 'Filemanager',
                        width: x * 0.8,
                        height: y * 0.8,
                        resizable: "yes",
                        close_previous: "no"
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
                        reader.onload = function() {
                            var id = 'blobid' + (new Date()).getTime();
                            var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                            var base64 = reader.result.split(',')[1];
                            var blobInfo = blobCache.create(id, file, base64);
                            blobCache.add(blobInfo);
                            cb(blobInfo.blobUri(), {
                                title: file.name
                            });
                        };
                    };
                    input.click();
                }
            };

            tinymce.init(editor_config);
        });
    </script>
@endsection
