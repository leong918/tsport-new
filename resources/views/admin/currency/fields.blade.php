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
            {{ html()->label('Code') }}
            {{ html()->text('code')->placeholder('Enter code')->class('form-control')->required() }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            {{ html()->label('Status') }}
            {{ html()->select('status')->options(renderSelect(Currency::STATUS))->class('form-control')->required() }}
        </div>
    </div>
</div>

@section('script')
@parent
<script src="{{ asset('assets/admin/js/tinymce.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/jquery.tinymce.min.js') }}"></script>
@endsection