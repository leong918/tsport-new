<x-alert />

@php
    use App\Plugins\SalesOrder\Models\CartRule;
@endphp

<div class="row mb-5">
    <div class="col-md-6">
        <div class="mb-3">
            {{ html()->label('Name') }}
            {{ html()->text('name')->class('form-control font_size')->required() }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            {{ html()->label('Type') }}
            {{ html()->select('type')->options(renderSelect(CartRule::TYPE))->class('form-control type')->required() }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            {{ html()->label('Coupon Code') }}
            {{ html()->text('coupon_code')->class('form-control coupon_code')->value(isset($model->coupon_code) ? $model->coupon_code : null) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            {{ html()->label('Target') }}
            <select class="form-control target_table" name="target_table">
                @foreach (renderSelect(CartRule::TARGET) as $key => $target)
                    <option value="{{ $key }}"
                        {{ isset($model) && $model->target_table == $key ? 'selected' : null }}>{{ $target }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-6 d-none targetCol product-target">
        <div class="mb-3">
            {{ html()->label('Product') }}
            <select class="form-select" id="target-select" name="table_id" data-placeholder="Choose product">
                @foreach ($productDropdown as $product_id => $product_name)
                    <option value={{ $product_id }}
                        {{ isset($model) && $model->table_id == $product_id ? 'selected' : '' }}>
                        {{ $product_name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-6 d-none targetCol category-target">
        <div class="mb-3">
            {{ html()->label('Category') }}
            <select class="form-select" id="category-select" name="table_id" data-placeholder="Choose category">
                @foreach ($categoryDropdown as $category_id => $category_name)
                    <option value={{ $category_id }}
                        {{ isset($model) && $model->table_id == $category_id ? 'selected' : '' }}>
                        {{ $category_name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-6 d-none targetCol brand-target">
        <div class="mb-3">
            {{ html()->label('Brand') }}
            <select class="form-select" id="brand-select" name="table_id" data-placeholder="Choose brand">
                @foreach ($brandDropdown as $brand_id => $brand_name)
                    <option value={{ $brand_id }}
                        {{ isset($model) && $model->table_id == $brand_id ? 'selected' : '' }}>
                        {{ $brand_name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            {{ html()->label('Discount Type') }}
            {{ html()->select('discount_type')->options(renderSelect(CartRule::DISCOUNT_TYPE))->value(isset($model) ? $model->discount_type : null)->class('form-control')->required() }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            {{ html()->label('Value') }}
            {{ html()->number('value')->attribute('step', '0.01')->attribute('min', '0.01')->class('form-control')->required() }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            {{ html()->label('Priority') }}
            {{ html()->number('priority')->attribute('min', '1')->class('form-control')->required() }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            {{ html()->label('Status') }}
            {{ html()->select('status')->options(renderSelect(CartRule::STATUS))->class('form-control')->required() }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            {{ html()->label('Start Date') }}
            <div class="input-group datePicker" data-td-target-input="nearest"
                data-td-target-toggle="nearest">
                <input id="start_date_input" type="datetime" class="form-control" name="start_date"
                    data-td-target="#start_date" data-td-toggle="datetimepicker" 
                    value="{{ isset($model) ? $model->start_date : null }}"/> 
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            {{ html()->label('End Date') }}
            <div class="input-group datePicker" data-td-target-input="nearest"
                data-td-target-toggle="nearest">
                <input id="end_date_input" type="datetime" class="form-control" name="end_date"
                    data-td-target="#end_date" data-td-toggle="datetimepicker" 
                    value="{{ isset($model) ? $model->end_date : null }}"/>
            </div>
        </div>
    </div>
</div>

@section('script')
    @parent
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.5.6/tinymce.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.5.6/jquery.tinymce.min.js"></script>
    <script>
        $(document).ready(function() {

            $('.datePicker').tempusDominus();

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

            function checkTargetTable() {
                var target_table = $('.target_table').val();
                $('.targetCol').addClass('d-none')
                $('.targetCol').find('select').prop('disabled', true)
                $('.' + target_table + '-target').removeClass('d-none');
                $('.' + target_table + '-target').find('select').prop('disabled', false)
            }

            function checkDate() {
                var start_date = $('#start_date_input').val();
                var end_date = $('#end_date_input').val();

                if (new Date(end_date) < new Date(start_date)) {
                    Swal.fire({
                        title: 'Error',
                        text: 'End date cannot be earlier than start date!',
                        icon: 'warning',
                        confirmButtonText: 'OK',
                    });

                    return false;
                }

                return true;
            }


            //------------- on render validation ----------------------
            @if (!isset($model))
                $('.coupon_code').prop('disabled', true);
                $('#product-select, #category-select, #brand-select').prop("disabled", true);
                $('.brandCol, .categoryCol, .productCol').addClass('d-none');
            @else
                $('.type').val() != 1 ? $('.coupon_code').prop('disabled', true) : $('.coupon_code').prop(
                    'disabled', false);
                checkTargetTable();
            @endif


            //--------------- type field on change --------------------
            $('.type').on('change', function() {
                $(this).val() != 0 ? $('.coupon_code').prop('disabled', false) : $('.coupon_code').prop(
                    'disabled', true).val('');
            });

            //---------------- target table field on change ------------------------
            $('.target_table').on('change', function() {
                checkTargetTable();
            });

            //------------------ submit ------------------------
            $("#cart_rule").submit(function(e) {
                e.preventDefault();

                var url = $(this).attr('action');

                let formData = new FormData(this);

                if (!checkDate()) {
                    return;
                };

                $(".form-control-file").each(function() {
                    formData.append($(this).attr("name"), $(this)[0].files[0]);
                })

                axios({
                        method: "post",
                        url: url,
                        data: formData,
                        headers: {
                            "Content-Type": "multipart/form-data"
                        },
                    })
                    .then(response => {
                        swal.fire({
                            title: 'Success',
                            text: 'Cart Rule Added!',
                            type: 'success',
                            confirmButtonClass: 'btn btn-success',
                            confirmButtonText: 'OK',
                        });
                        setTimeout(function() {
                            window.location.replace('/admin/cart_rule/index');
                        }, 1000);
                    })
                    .catch(error => {
                        swal.fire({
                            title: 'Fail',
                            text: error.response.data.msg,
                            type: 'error',
                            confirmButtonClass: 'btn btn-danger',
                            confirmButtonText: 'OK',
                        });
                    });
            });
        });
    </script>
@endsection
