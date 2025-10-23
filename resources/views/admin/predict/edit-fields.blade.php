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
        <div class="card-header"><strong>Predict</strong> </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        {{ html()->label('Match') }}
                        {{ html()->select('match_id')->options(
                                $match->mapWithKeys(function ($m) {
                                    return [
                                        $m->id => $m->match_title . ' (' . $m->start_at . ')',
                                    ];
                                }),
                            )->class('form-control') }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        {{ html()->label('Character') }}
                        {{ html()->select('character_name')->options(renderSelect(Predict::CHARACTER))->class('form-control')->id('character-select') }}
                    </div>
                    <!-- Character Image Preview -->
                    <div class="mb-3" id="character-preview" style="display: none;">
                        <label class="form-label">Character Preview</label>
                        <div class="character-image-container">
                            <img id="character-image" src="" alt="Character Preview" class="img-fluid rounded" style="max-width: 150px; max-height: 150px;">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        {{ html()->label('Status') }}
                        {{ html()->select('status')->options(renderSelect(Predict::STATUS))->class('form-control') }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        {{ html()->label('Prediction Box Image') }}
                        {{ html()->file('image')->class('form-control')->accept('image/*') }}
                        <small class="text-muted">Upload prediction box image (JPG, PNG, etc.)</small>
                        @if(isset($model) && $model->image)
                            <!-- Hidden field to store original image path -->
                            {{ html()->hidden('original_image', $model->image) }}
                            <div class="mt-2">
                                <label class="form-label">Current Image:</label><br>
                                <img src="{{ $model->image_url }}" alt="Current Prediction Image" class="img-fluid rounded" style="max-width: 200px; max-height: 150px;">
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-3">
                        {{ html()->label('Description') }}
                        {{ html()->textarea('description')->class('form-control wysiwyg') }}
                        <small class="text-danger" id="error_content"></small>
                    </div>
                </div>

                <div class="card-body table-listing table-responsive">
                    {{ html()->label('Comment & Like') }}

                    <table class="table comment-table table-bordered">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Comment</th>
                                <th>Like</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                    </table>
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
                min_height: 300,
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

            // Character image preview functionality
            $('#character-select').on('change', function() {
                const selectedCharacter = $(this).val();
                const characterImages = {
                    'Expert1': '{{ asset("assets/web/images/predict/ip-active-1.png") }}',
                    'Expert2': '{{ asset("assets/web/images/predict/ip-active-2.png") }}',
                    'Expert3': '{{ asset("assets/web/images/predict/ip-active-3.png") }}'
                };

                if (selectedCharacter && characterImages[selectedCharacter]) {
                    $('#character-image').attr('src', characterImages[selectedCharacter]);
                    $('#character-image').attr('alt', selectedCharacter);
                    $('#character-preview').show();
                } else {
                    $('#character-preview').hide();
                }
            });

            // Trigger change event if there's a pre-selected value
            $('#character-select').trigger('change');
        });

        $(function() {
            var table = $('.comment-table').DataTable({
                bSort: true,
                processing: true,
                autoWidth: false,
                serverSide: true,
                ordering: false,
                ajax: {
                    url: "{!! route('admin.predict.update', ['id' => $model->id]) !!}",
                    data: function(d) {
                        var form = {};
                        $.each($('#form').serializeArray(), function() {
                            form[this.name] = this.value;
                        });
                        d.form_data = form;
                    },
                },
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'comment',
                        name: 'comment',
                        width: '30%'
                    },
                    {
                        data: 'like',
                        name: 'like'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        searchable: false,
                        sortable: false,
                    }
                ]
            });

            $('#form-submit').click(function() {
                table.draw();
            })

            $('table tbody').on('click', '.btn-delete', function(e) {
                e.preventDefault();
                var url = $(this).data('url');
                swal.fire({
                    title: 'Are you sure?',
                    text: 'This action is not able to be reverted.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel',
                    customClass: {
                        confirmButton: "btn btn-success me-2",
                        cancelButton: "btn btn-danger ms-2"
                    },
                    buttonsStyling: false,
                    showLoaderOnConfirm: true,
                    preConfirm: (response) => {
                        if (response) {
                            return axios.delete(url, {})
                                .then(() => {
                                    table.ajax.reload();
                                })
                                .catch((e) => {
                                    console.error("error ", e)
                                    Swal.showValidationMessage(
                                        `Request failed: ${e}`
                                    );
                                })
                        }
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                    if (result.value) {
                        swal.fire({
                            title: 'Deleted!',
                            text: 'Record deleted successfully!',
                            icon: 'success',
                        });
                        table.ajax.reload();
                    }
                });
            });

            $('table tbody').on('click', '.btn-status', function() {
                var url = $(this).data("url");
                swal.fire({
                    title: 'Are you sure?',
                    text: 'This action is not able to be reverted.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, change it!',
                    cancelButtonText: 'Cancel',
                    customClass: {
                        confirmButton: "btn btn-success me-2",
                        cancelButton: "btn btn-danger ms-2"
                    },
                    buttonsStyling: false,
                    showLoaderOnConfirm: true,
                    preConfirm: (response) => {
                        if (response) {
                            return axios.post(url, {})
                                .then(() => {
                                    table.ajax.reload();
                                })
                                .catch((e) => {
                                    console.error("error ", e)
                                    Swal.showValidationMessage(
                                        `Request failed: ${e}`
                                    );
                                })
                        }
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                    if (result.value) {
                        swal.fire({
                            title: 'Updated!',
                            text: 'Record updated successfully!',
                            icon: 'success',
                        });
                        // reload datatables
                        table.ajax.reload();
                    }
                });
            });

            $('table tbody').on('click', '.btn-comment', function(e) {
                $('.index-table').data('dt_params', {
                    id: $(this).data('id')
                });
                $('.index-table').DataTable().draw();
                indexTable.draw();
            });
        });

        $("#topic-form").submit(function(e) {
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

            // Testing passed values
            //for (var pair of formData.entries()) {
            //    console.log(pair[0]+ ', ' + pair[1]); 
            //}

            //return;

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
