@section('style')
@parent
<link rel="stylesheet" href="{{ asset('assets/admin/css/select2.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/admin/css/select2-bootstrap-5-theme.min.css') }}" />
@endsection

<style>
    .select2-container--bootstrap-5 .select2-selection--multiple .select2-selection__rendered .select2-selection__choice .select2-selection__choice__remove {
        padding: 0.50em !important;
        /* Adjust padding as needed */
    }

    select[readonly="readonly"] {
        pointer-events: none;
        background-color: #f2f2f2;
    }
</style>

<x-alert />
<div class="col-sm-12">
    <div class="card mb-3">
        <div class="card-header"><strong>Blog</strong> </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        {{ html()->label('Blog Category') }}
                        <select name="blog_category_id" class="form-control" id="blog_category_id">
                            @foreach ($blogCategoryDropdown as $category)
                                <option value="{{ $category->id }}" data-is-private="{{ $category->is_private }}" {{
                                    old('blog_category_id', isset($model) && $model->blog_category_id == $category->id ? 'selected' : '') }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        {{ html()->label('Ranking') }}<small class="text-secondary"> (數字愈大, 排名愈高)</small>
                        {{ html()->number('sort')->placeholder('Enter sort')->attribute('min', 0)
                            ->value(old('sort', isset($model) && $model->sort ? $model->sort : 0))->class('form-control requiredInput') }}
                        <small class="text-danger errorMessage"></small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        {{ html()->label('Status') }}
                        {{ html()->select('status')->options(renderSelect(Blog::STATUS))->class('form-control') }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        {{ html()->label('Published Date') }}
                        <div class="input-group datePicker" data-td-target-input="nearest" data-td-target-toggle="nearest">
                            <input type="datetime" class="form-control" name="published_at" data-td-toggle="datetimepicker"
                                value="{{ old('published_at', isset($model) ? $model->published_at : '') }}" autocomplete="off" />
                        </div>
                        <small class="text-danger errorMessage"></small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        {{ html()->label('Image <b>(Below 300kb, Recommended Size: 324px X 215px)</b>') }}
                        {{ html()->file('image')->accept('image/*')->class('form-control image-uploader' .
                        (isset($model) && $model->image ? '' : ' requiredInput')) }}
                        <small class="text-danger errorMessage"></small>
                        {{ html()->hidden('original_image')->value(isset($model) && $model->image ? $model->image : '')
                        }}
                        <div class="my-3">
                            <div id="image-preview-container"></div>
                        </div>
                        @if (isset($model) && $model->image)
                        <div class="mb-3">
                            <label>Original Image Preview</label>
                            <div class="col-3 d-flex justify-content-center">
                                <img class="img-fluid" {{ $model->image ? 'src=' . $model->image : '' }} />
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-sm-12">
    <div class="row">
        <div class="col-sm-6">
            <div class="card mb-3">
                <div class="card-header"><strong>English</strong></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                {{ html()->label('Name') }}
                                {{ html()->text('language[en][name]')->placeholder('Enter name')
                                    ->value(old('language.en.name', isset($model) && $model->getParameters('en') ? $model->getParameters('en')->name : ''))
                                    ->class('form-control requiredInput') }}
                                <small class="text-danger errorMessage"></small>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                {{ html()->label('Content') }}
                                {{ html()->textarea('language[en][content]')
                                    ->value(old('language.en.content', isset($model) && $model->getParameters('en') ? e($model->getParameters('en')->content) : ''))
                                    ->id('en_content')->class('form-control wysiwyg requiredInput') }}
                                <small class="text-danger errorMessage"></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card mb-3">
                <div class="card-header"><strong>Simplified Chinese</strong></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                {{ html()->label('Name') }}
                                {{ html()->text('language[sc][name]')->placeholder('Enter name')
                                    ->value(old('language.sc.name', isset($model) && $model->getParameters('sc') ? $model->getParameters('sc')->name : ''))
                                    ->class('form-control requiredInput') }}
                                <small class="text-danger errorMessage"></small>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                {{ html()->label('Content') }}
                                {{ html()->textarea('language[sc][content]')
                                    ->value(old('language.sc.content', isset($model) && $model->getParameters('sc') ? e($model->getParameters('sc')->content) : ''))
                                    ->class('form-control wysiwyg requiredInput') }}
                                <small class="text-danger errorMessage"></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card mb-3">
                <div class="card-header"><strong>Traditional Chinese</strong></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                {{ html()->label('Name') }}
                                {{ html()->text('language[tc][name]')->placeholder('Enter name')
                                    ->value(old('language.tc.name', isset($model) && $model->getParameters('tc') ? $model->getParameters('tc')->name : ''))
                                    ->class('form-control requiredInput') }}
                                <small class="text-danger errorMessage"></small>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                {{ html()->label('Content') }}
                                {{ html()->textarea('language[tc][content]')
                                    ->value(old('language.tc.content', isset($model) && $model->getParameters('tc') ? e($model->getParameters('tc')->content) : ''))
                                    ->class('form-control wysiwyg requiredInput') }}
                                <small class="text-danger errorMessage"></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('script')
@parent
<script src="{{ asset('assets/admin/js/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/select2.min.js') }}"></script>
<script>
    $(document).ready(function() {
            $('.datePicker').tempusDominus({
                localization: {
                    format: 'yyyy-MM-dd'
                },
                display: {
                    components: {
                        clock: false // hide clock button
                    }
                }
            });

            var editor_config = {
                path_absolute: "{{ config('app.url') . '/' }}",
                selector: "textarea.wysiwyg",
                min_height:300,
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
                promotion: false,
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
                },
            };

            tinymce.init(editor_config);
        });

        $("#blog-form").submit(function(e) {
            e.preventDefault();
            tinymce.triggerSave();
            var url = $(this).attr('action');
            let formData = new FormData(this);
            $(".form-control-file").each(function() {
                formData.append($(this).attr("name"), $(this)[0].files[0]);
            })
            var can_submit = true;
            var publishedErrMsgElement = $('input[name="published_at"]').closest('.mb-3').find('.errorMessage');
            publishedErrMsgElement.text('');

            $(this).find('.requiredInput').each(function() {
                var errorMessageElement = $(this).siblings('.errorMessage');
                errorMessageElement.text('');

                if ($(this).val() == '') {
                    can_submit = false;
                    errorMessageElement.text('Field is required');
                }
            });

            if ($('input[name="published_at"]').val() == '') {
                can_submit = false;
                publishedErrMsgElement.text('Field is required');
            }

            if (can_submit) {
                $(this).find("button[type=submit]").attr("disabled", true);
                this.submit();
            }
        });
</script>
@endsection