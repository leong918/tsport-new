<x-alert />

<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            {{ html()->label('First Name') }}
            {{ html()->text('first_name')->placeholder('Enter first name')->class('form-control')->required() }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            {{ html()->label('Last Name') }}
            {{ html()->text('last_name')->placeholder('Enter last name')->class('form-control')->required() }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            {{ html()->label('Username') }}
            {{ html()->text('username')->placeholder('Enter username')->class('form-control')->required() }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            {{ html()->label('Email') }}
            {{ html()->text('email')->placeholder('Enter email')->class('form-control')->required() }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            {{ html()->label('Phone no') }}
            {{ html()->text('phone_no')->placeholder('Enter phone no')->class('form-control')->required() }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            {{ html()->label('Date of Birth') }}
            <div class="input-group datePicker" data-td-target-input="nearest"
                data-td-target-toggle="nearest">
                <input id="dobDatePicker" type="datetime" class="form-control" name="dob"
                    data-td-target="#dob" data-td-toggle="datetimepicker" 
                    value="{{ isset($model) ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $model->dob)->format('d/m/Y') : null }}"/>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            {{ html()->label('Referral Email') }}
            {{ html()->text('referral_email')->placeholder('Enter referral email')->class('form-control') }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            {{ html()->label('Referral Phone no') }}
            {{ html()->text('referral_phone_no')->placeholder('Enter referral phone no')->class('form-control') }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            {{ html()->label('Password') }}
            {{ html()->password('password')->placeholder('Enter password')->class('form-control')->required(!isset($model) ?? false) }}
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
    <a href="{{ route("admin.user.index") }}" class="btn btn-warning">Cancel</a>
    <button type="submit" class="btn btn-primary">Submit</button>
</div>

@section('script')
@parent
<script>
    $(document).ready(function() { 
        $('#dobDatePicker').tempusDominus({
                localization: {
                    format: 'dd/MM/yyyy'
                }
            });
        });
</script>
@endsection