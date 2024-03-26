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
            {{ html()->label('Status') }}
            {{ html()->select('status')->options(renderSelect(Admin::STATUS))->class('form-control')->required() }}
        </div>
    </div>
</div>

<div class="mb-3 float-end">
    <a href="{{ route("admin.country.index") }}" class="btn btn-warning">Cancel</a>
    <button type="submit" class="btn btn-primary">Submit</button>
</div>