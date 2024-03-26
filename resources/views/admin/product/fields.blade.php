@section('style')
    @parent
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endsection
<style>
    .select2-container--bootstrap-5 .select2-selection--multiple .select2-selection__rendered .select2-selection__choice .select2-selection__choice__remove {
        padding: 0.50em !important; /* Adjust padding as needed */
    }
</style>

<x-alert />
<div class="col-sm-12">
    <div class="card mb-3">
        <div class="card-header">
            <strong>Product</strong>
            @if (isset($model) && $model->is_attribute == 0)
                <button type="button" id="add_product_price" data-bs-toggle="modal" data-bs-target="#stockModal"
                    class="btn btn-success permission float-end">
                    Stock Adjustment
                </button>
            @endif

        </div>
        <div class="card-body">
            <div class="row product-field-wrapper">
                <div class="col-md-6">
                    <div class="mb-3">
                        {{ html()->label('Name') }}
                        {{ html()->text('name')->id('productName')->placeholder('Enter name')->class('form-control')->required() }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        {{ html()->label('Alias') }}
                        {{ html()->text('alias')->id('alias')->placeholder('Enter alias')->class('form-control')->required() }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        {{ html()->label('SKU') }}
                        {{ html()->text('sku')->placeholder('Enter SKU')->class('form-control')->required() }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        {{ html()->label('Price') }}    
                        {{ html()->number('product_price')->class('form-control')->attributes(['min' => '0.01','step' => '0.01'])->value(isset($model) && count($model->productPrice) > 0 ? $model->productPrice->first()->price : null )->required() }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        {{ html()->label('Category ID') }}
                        {{ html()->select('category_id')->options($categoryDropdown)->class('form-control')->required() }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        {{ html()->label('Brand ID') }}
                        {{ html()->select('brand_id')->options($brandDropdown)->class('form-control')->required() }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        {{ html()->label('Status') }}
                        {{ html()->select('status')->options(renderSelect(Brand::STATUS))->class('form-control')->required() }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        {{ html()->label('Product Tag') }}
                        <select class="form-multi-select" id="product-tag-select" name="product_tag[]" multiple
                            data-placeholder="Choose product tag">
                            @foreach ($tagDropdown as $tag_id => $tag_name)
                                <option value={{ $tag_id }}
                                    {{ isset($model) && $model->checkTag($model->id, $tag_id) ? 'selected' : '' }}>
                                    {{ $tag_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        {{ html()->label('Point') }}
                        {{ html()->number('point')->placeholder('Enter point')->attribute('min', 0)->class('form-control') }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        {{ html()->label('Sort') }}
                        {{ html()->number('sort')->placeholder('Enter sort')->attribute('min', 0)->class('form-control')->required() }}
                    </div>
                </div>
                @if (!isset($model))
                    <div class="col-md-6">
                        <div class="mb-3">
                            {{ html()->label('Quantity') }}
                            {{ html()->number('quantity')->placeholder('Enter quantity')->attribute('min', 1)->class('form-control')->required() }}
                        </div>
                    </div>
                @endif
                <div class="col-md-6">
                    <div class="mb-3">
                        {{ html()->label('New') }}
                        {{ html()->select('is_new')->options(['No', 'Yes'])->class('form-control')->required() }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        {{ html()->label('Best Seller') }}
                        {{ html()->select('is_best_seller')->options(['No', 'Yes'])->class('form-control')->required() }}
                    </div>
                </div>
                @if (!isset($model))
                    <div class="col-md-6">
                        <div class="mb-3">
                            {{ html()->label('Has Attribute') }}
                            {{ html()->select('is_attribute')->options(['No', 'Yes'])->class('form-control')->required() }}
                        </div>
                    </div>
                @endif
                <div class="col-md-6">
                    <div class="mb-3">
                        {{ html()->label('Has Backorder') }}
                        {{ html()->select('is_backorder')->options(['No', 'Yes'])->class('form-control is_backorder')->required() }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        {{ html()->label('Related Product') }}
                        <select class="form-select" id="product-related-select" name="product_related[]"
                            data-placeholder="Choose related product" multiple>
                            @foreach ($productDropdown as $product_id => $product_name)
                                <option value={{ $product_id }}
                                    {{ isset($model) && $model->checkProductRelated($product_id, $model->id) ? 'selected' : '' }}>
                                    {{ $product_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        {{ html()->label('Image') }}
                        {{ html()->file('image[]')->accept('image/*')->multiple()->class('form-control')->required(isset($model) && $model->productImage->count() > 0 ? false : true) }}
                        <br />
                        @if (isset($model) && $model->productImage->count() > 0)
                            <div class="row">
                                @foreach ($model->productImage as $image)
                                    <div class="col-3">
                                        <img class="img-fluid" src={{ $image->url }} />
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('script')
@parent
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.5.6/tinymce.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.5.6/jquery.tinymce.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/mustache@4.2.0/mustache.min.js"></script>

<script>
    $(document).ready(function() { 
        $('#product-related-select, #product-tag-select').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            closeOnSelect: false,
            allowClear: true,
        });

        //-----------------  for stock adjustment when update product (no attribute)   ---------------------------
        currentStockStatus = 'IN';

        function updateStatus(status) {
            currentStockStatus = status;
        }

        $('.addBtn').on('click', function() {
            $('.stockStatus').val('ADD');
            updateStatus('IN');
        });

        $('.minusBtn').on('click', function() {
            $('.stockStatus').val('MINUS');
            updateStatus('OUT');
        });


        //---------------- on render checkbox -----------------
        $('input[type="checkbox"][data-checkbox]').each(function() {
            var checkboxValue = $(this).data('checkbox');

            if (checkboxValue == 1) {
                $(this).prop('checked', true);
            }
        });

        //----- stock update submmission ------------
        $('#stock').submit(function(e) {
            e.preventDefault();

            var url = $(this).attr('action');

            let formData = new FormData(this);

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
                    text: 'Stock updated!',
                    type: 'success',
                    confirmButtonClass: 'btn btn-success',
                    confirmButtonText: 'OK',
                });
                setTimeout(function() {
                    window.location.replace('/admin/product/index');
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
        })

        //-------- display product attribute field by on change (create product) -----------
        $('select[name="is_attribute"]').on('change', function() {

            if ($(this).val() == 1) {
                $('input[name="quantity"]').prop('disabled', true).val('');
                $('.product-attribute-input').show();
                $('.optionContent .form-control').prop('disabled', false);

            } else {
                $('input[name="quantity"]').prop('disabled', false);
                $('.product-attribute-input').hide();
                $('.optionContent .form-control').prop('disabled', true);
            }
        });

        //--------- set initial product attribute field ---------
        $('select[name="is_attribute"]').trigger('change');
            
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

        //check user typing for product name 
        var typingTimer;
        var doneTypingInterval = 500; // Adjust this value as needed (milliseconds)

        $('#productName').keyup(function() {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(doneTyping, doneTypingInterval);
        });

        function doneTyping() {
            var inputString = $('#productName').val().trim().toLowerCase().replace(/\s+/g, '-');
            var organizedString = inputString.replace(/[^\w\u4E00-\u9FFF\-]/g, '');

            $('#alias').val(organizedString);
        }

        //------------------------------------------------------------------------------------------
        var additionalTermOption = 0;
        var attributeCount = 1;
        var attributeCountOnRender = $('.optionContent').length;
        // var termCountOnRender = $('.termWrapper').length;

        if (attributeCountOnRender > 1) {
            $('.optionContent:not(:first-child)').addClass('mt-3');
            $('.optionContent:not(:first-child) .back').append(
                '<button class="btn btn-danger btn-remove-option" type="button"><i class="fas fa-trash-alt"></i></button>'
                );
            $('.termWrapper:not(:first-child) .termBtnControl').append(
                '<button class="btn btn-danger btn-remove-variation ms-2" type="button"><i class="fas fa-trash-alt"></i></button>'
                )
        }

        $('body').on('click', '.btn-remove-option', function() {
            $(this).parents('.optionContent').remove();
        })

        $('body').on('click', '.btn-remove-variation', function() {
            $(this).parents('.termWrapper').remove();
        })

        $('body').on('click', '.btn-addOption', function() {
            var option_id = $(this).parents('.optionContent').data('option-id');
            var template = document.getElementById('optionVariationLayout').innerHTML;
            var rendered = Mustache.render(template, {
                id: option_id,
                variation_id: additionalTermOption,
            });
            $(this).parents('.optionContent').find('.list-group').append(rendered);
            additionalTermOption++;

            // console.log(attributeCount, additionalTermOption, '?',  attributeCountOnRender);

        })

        $('#addOptionBtn').on('click', function() {
            var template = document.getElementById('moreOptionLayout').innerHTML;
            var rendered = Mustache.render(template, {
                id: attributeCount,
                variation_id: additionalTermOption,
            });
            $('#optionContent').append(rendered);
            attributeCount++;
            additionalTermOption++;

            // console.log(attributeCount, additionalTermOption, '?',  attributeCountOnRender);
        })

        // console.log(attributeCount, additionalTermOption, '?',  attributeCountOnRender, termCountOnRender);


        $("#product").submit(function(e) {
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
                headers: {
                    "Content-Type": "multipart/form-data"
                },
            })
            .then(response => {
                swal.fire({
                    title: 'Success',
                    text: 'Product Added!',
                    type: 'success',
                    confirmButtonClass: 'btn btn-success',
                    confirmButtonText: 'OK',
                });
                setTimeout(function() {
                    window.location.replace('/admin/product/index');
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
