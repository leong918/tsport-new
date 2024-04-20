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
            {{ html()->text('code')->placeholder('Enter country code')->class('form-control')->required()->attributes(['maxlength' => 3]) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            {{ html()->label('Delivery Partner') }}
            {{ html()->text('delivery_partner')->placeholder('Enter delivery partner')->class('form-control')->required() }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            {{ html()->label('Min Spend For Free Delivery (If no free delivery leave it blank)') }}
            {{ html()->number('min_spend_free_delivery')->placeholder('Enter min spend for free delivery')->class('form-control') }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            {{ html()->label('Delivery Flat Rate (If COD or PayLater leave it blank)') }}
            {{ html()->number('delivery_flat_rate')->placeholder('Enter delivery flat rate')->class('form-control') }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            {{ html()->label('Status') }}
            {{ html()->select('status')->options(renderSelect(Country::STATUS))->class('form-control')->required() }}
        </div>
    </div>
</div>

<div class="mb-3 float-end">
    <a href="{{ route("admin.country.index") }}" class="btn btn-warning">Cancel</a>
    <button type="submit" class="btn btn-primary">Submit</button>
</div>