@extends('admin.layout.app')

@section('style')
    @parent
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endsection
<style>
    .select2-container--bootstrap-5 .select2-selection--multiple .select2-selection__rendered .select2-selection__choice .select2-selection__choice__remove {
        padding: 0.50em !important;
        /* Adjust padding as needed */
    }
</style>

@section('content')
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <x-alert />
                <div class="row">
                    <div class="col-sm-12">
                        {{ html()->form('POST', route('admin.setting.updateSlider.post'))->acceptsFiles()->id('main_slider')->open() }}

                        <div class="card mb-3">
                            <div class="card-header"><strong>Main Slider</strong></div>
                            <div class="card-body table-listing table-responsive">
                                <div class="row product-field-wrapper">
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        {{ html()->label('Image') }}
                                                        {{ html()->file('main_slider_image')->accept('image/*')->class('form-control')->required() }}
                                                    </div>
                                                    <div class="mb-3">
                                                        {{ html()->label('Mobile Image') }}
                                                        {{ html()->file('mobile_image')->accept('image/*')->class('form-control')->required() }}
                                                    </div>
                                                    <div class="mb-3">
                                                        {{ html()->label('URL') }}
                                                        {{ html()->text('main_url')->id('main_url')->placeholder('Enter URL')->class('form-control')->required() }}
                                                        <input type="text" name="type" value="main" hidden>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <div class="float-end">
                                                    <button class="btn btn-success" type="submit">Upload</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            @foreach ($slider_model as $slider)
                                                @if ($slider['type'] == 'main')
                                                    <div class="col-md-4 mb-3">
                                                        <div class="container position-relative p-0">
                                                            <img class="img-fluid" src={{ $slider['image'] }} />
                                                            <a href="#" data-url='{{ route('admin.setting.destroy.delete', ['id' => $slider['id']]) }}'
                                                                class='removeSubImage btn btn-delete btn-danger position-absolute rounded-circle p-2'
                                                                style="top: -7px; right: -5px">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{ html()->form()->close() }}



                        <div class="card mb-3">
                            <div class="card-header"><strong>Sub Slider</strong></div>
                            <div class="card-body">
                                <div class="row product-field-wrapper">
                                    <div class="col-md-12">
                                        {{ html()->model($setting_model)->form('POST', route('admin.setting.updateHomepageSetting.post'))->acceptsFiles()->id('sub_slider')->open() }}

                                        <div class="mb-3">
                                            {{ html()->label('Section Title') }}
                                            <div class="input-group">
                                                {{ html()->text('sub_slider_title')->id('sub_slider_title')->placeholder('Enter Title')->class('form-control')->required() }}
                                                <button class="btn btn-primary" type="submit">Submit</button>
                                            </div>
                                        </div>

                                        {{ html()->form()->close() }}

                                    </div>

                                    <div class="col-md-6">
                                        {{ html()->form('POST', route('admin.setting.updateSlider.post'))->acceptsFiles()->id('sub_slider')->open() }}

                                        <div class="card">
                                            <div class="card-body">
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        {{ html()->label('Image') }}
                                                        {{ html()->file('sub_slider_image')->accept('image/*')->class('form-control')->required() }}
                                                    </div>
                                                    <div class="mb-3">
                                                        {{ html()->label('URL') }}
                                                        {{ html()->text('sub_url')->id('sub_url')->placeholder('Enter URL')->class('form-control')->required() }}
                                                        <input type="text" name="type" value="sub" hidden>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <div class="float-end">
                                                    <button class="btn btn-success" type="submit">Upload</button>
                                                </div>
                                            </div>
                                        </div>
                                        {{ html()->form()->close() }}

                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            @foreach ($slider_model as $slider)
                                                @if ($slider['type'] == 'sub')
                                                    <div class="col-md-4 mb-3">
                                                        <div class="container position-relative p-0">
                                                            <img class="img-fluid" src={{ $slider['image'] }} />
                                                            <a href="#" data-url='{{ route('admin.setting.destroy.delete', ['id' => $slider['id']]) }}'
                                                                class='removeSubImage btn btn-delete btn-danger position-absolute rounded-circle p-2'
                                                                style="top: -7px; right: -5px">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{ html()->form()->close() }}


                        {{ html()->model($setting_model)->form('POST', route('admin.setting.updateHomepageSetting.post'))->acceptsFiles()->id('section_right')->open() }}

                        <div class="card mb-3">
                            <div class="card-header"><strong>Section Right Products</strong></div>
                            <div class="card-body">
                                <div class="row product-field-wrapper">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            {{ html()->label('Section Title') }}
                                            {{ html()->text('section_right_title')->id('section_right_title')->placeholder('Enter Title')->class('form-control')->required() }}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            {{ html()->label('Products') }}
                                            <select class="form-select" id="product-right-select"
                                                name="product_right_select[]" data-placeholder="Choose product" multiple required>
                                                @foreach ($productDropdown as $product_id => $product_name)
                                                    @php
                                                        $isSelected = isset($setting_model['product_right_select']) && in_array($product_id, json_decode($setting_model['product_right_select']));
                                                    @endphp
                                                    <option value="{{ $product_id }}" {{ $isSelected ? 'selected' : '' }}>
                                                        {{ $product_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="float-end">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                        {{ html()->form()->close() }}


                        {{ html()->model($setting_model)->form('POST', route('admin.setting.updateHomepageSetting.post'))->acceptsFiles()->id('section_left')->open() }}

                        <div class="card mb-3">
                            <div class="card-header"><strong>Section Left Products</strong></div>
                            <div class="card-body">
                                <div class="row product-field-wrapper">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            {{ html()->label('Section Title') }}
                                            {{ html()->text('section_left_title')->id('section_left_title')->placeholder('Enter Title')->class('form-control')->required() }}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            {{ html()->label('Products') }}
                                            <select class="form-select" id="product-left-select"
                                                name="product_left_select[]" data-placeholder="Choose product" multiple required>
                                                @foreach ($productDropdown as $product_id => $product_name)
                                                    @php
                                                        $isSelected = isset($setting_model['product_left_select']) && in_array($product_id, json_decode($setting_model['product_left_select']));
                                                    @endphp
                                                    <option value="{{ $product_id }}" {{ $isSelected ? 'selected' : '' }}>
                                                        {{ $product_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="float-end">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                        {{ html()->form()->close() }}


                        {{ html()->model($setting_model)->form('POST', route('admin.setting.updateHomepageSetting.post'))->acceptsFiles()->id('section_center')->open() }}

                        <div class="card mb-3">
                            <div class="card-header"><strong>Section Center Products</strong></div>
                            <div class="card-body">
                                <div class="row product-field-wrapper">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            {{ html()->label('Section Title') }}
                                            {{ html()->text('section_center_title')->id('section_center_title')->placeholder('Enter Title')->class('form-control')->required() }}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            {{ html()->label('Products') }}
                                            <select class="form-select" id="product-center-select"
                                                name="product_center_select[]" data-placeholder="Choose product" multiple required>
                                                @foreach ($productDropdown as $product_id => $product_name)
                                                    @php
                                                        $isSelected = isset($setting_model['product_center_select']) && in_array($product_id, json_decode($setting_model['product_center_select']));
                                                    @endphp
                                                    <option value="{{ $product_id }}" {{ $isSelected ? 'selected' : '' }}>
                                                        {{ $product_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="float-end">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                        {{ html()->form()->close() }}


                        {{ html()->model($setting_model)->form('POST', route('admin.setting.updateHomepageSetting.post'))->acceptsFiles()->id('section_recommended')->open() }}

                        <div class="card mb-3">
                            <div class="card-header"><strong>Section Recommended Products</strong></div>
                            <div class="card-body">
                                <div class="row product-field-wrapper">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            {{ html()->label('Section Title') }}
                                            {{ html()->text('recommended_title')->id('recommended_title')->placeholder('Enter Title')->class('form-control')->required() }}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            {{ html()->label('Products') }}
                                            <select class="form-select" id="product-recommended-select"
                                                name="product_recommended_select[]" data-placeholder="Choose product"
                                                multiple required>
                                                @foreach ($productDropdown as $product_id => $product_name)
                                                    @php
                                                        $isSelected = isset($setting_model['product_recommended_select']) && in_array($product_id, json_decode($setting_model['product_recommended_select']));
                                                    @endphp
                                                    <option value="{{ $product_id }}" {{ $isSelected ? 'selected' : '' }}>
                                                        {{ $product_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="float-end">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                        {{ html()->form()->close() }}

                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('script')
    @parent
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>

    <script>
        $(document).ready(function() {
            $('#product-left-select, #product-center-select, #product-recommended-select').select2({
                theme: "bootstrap-5",
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                    'style',
                placeholder: $(this).data('placeholder'),
                closeOnSelect: false,
                allowClear: true,
            });

            $("#product-right-select").select2({
                theme: "bootstrap-5",
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                    'style',
                placeholder: $(this).data('placeholder'),
                closeOnSelect: false,
                allowClear: true,
                maximumSelectionLength: 4,
            });

            $('.removeSubImage').on('click', function (e) {
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
                            text: 'Image deleted successfully!',
                            icon: 'success',
                        }).then(() => {
                            location.reload();
                        })
                        
                    }
                });

            });
        });
    </script>
@endsection
