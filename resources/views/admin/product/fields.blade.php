<x-alert />

<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            {{ html()->label('Name') }}
            {{ html()->text('name')->placeholder('Enter name')->class('form-control')->required() }}
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
            {{ html()->label('Related Product') }}
            <select class="form-multi-select" name="product_related[]" multiple data-coreui-search="true">
                @foreach($productDropdown as $product_id => $product_name)
                    <option value={{$product_id}} {{isset($model) && $model->checkProductRelated($product_id, $model->id) ? 'selected' : ''}}>{{$product_name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            {{ html()->label('Sort') }}
            {{ html()->number('sort')->placeholder('Enter sort')->attribute('min', 0)->value( isset($model) && $model->sort ? $model->sort : 0)->class('form-control')->required() }}
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
            {{ html()->label('Best Seller') }}
            {{ html()->select('is_best_seller')->options(['Yes','No'])->class('form-control')->required() }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            {{ html()->label('New') }}
            {{ html()->select('is_new')->options(['Yes','No'])->class('form-control')->required() }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            {{ html()->label('Image') }}
            {{ html()->file('image[]')->accept('image/*')->multiple()->class('form-control')->required(isset($model) && $model->productImage->count() > 0 ? false : true)}}
            <br />
            @if(isset($model) && $model->productImage->count() > 0)
            <div class="row">
                @foreach($model->productImage as $image)
                    <div class="col-3">
                        <img class="img-fluid" src={{ $image->url }} />
                    </div>
                @endforeach
            </div>
            @endif
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
                headers: { "Content-Type": "multipart/form-data" },
            })
            .then(response => {
                swal.fire({
                    title: '{{__("page.product_added")}}',
                    text: '{{__("page.txt_product_added")}}',
                    type: 'success',
                    confirmButtonClass: 'btn btn-success',
                        confirmButtonText: '{{__("page.ok")}}',
                });
                setTimeout(function(){
                    window.location.replace('/admin/product/index');
                }, 1000);
            })
            .catch(error => {
                swal.fire({
                    title: '{{__("page.product_fail_add")}}',
                    text: error.response.data.msg,
                    type: 'error',
                    confirmButtonClass: 'btn btn-danger',
                    confirmButtonText: '{{__("page.ok")}}',
                });
            });
        });
    });
</script>
@endsection