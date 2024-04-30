<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            {{ html()->label('First Name') }}
            {{ html()->text('first_name')->placeholder('Enter first name')->class('form-control requiredClass') }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            {{ html()->label('Last Name') }}
            {{ html()->text('last_name')->placeholder('Enter last name')->class('form-control requiredClass') }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            {{ html()->label('Username') }}
            {{ html()->text('username')->placeholder('Enter username')->class('form-control requiredClass') }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            {{ html()->label('Email') }}
            {{ html()->email('email')->placeholder('Enter email')->class('form-control requiredClass') }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            {{ html()->label('Phone no') }}
            {{ html()->number('phone_no')->placeholder('Enter phone no')->class('form-control requiredClass') }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            {{ html()->label('Date of Birth') }}
            <div class="input-group datePicker" data-td-target-input="nearest"
                data-td-target-toggle="nearest">
                <input id="dobDatePicker" type="datetime" class="form-control requiredClass" name="dob"
                    data-td-target="#dob" data-td-toggle="datetimepicker" 
                    value="{{ isset($model) ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $model->dob)->format('d/m/Y') : null }}"/>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            {{ html()->label('Referral Email (Optional)') }}
            {{ html()->email('referral_email')->placeholder('Enter referral email')->class('form-control') }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            {{ html()->label('Referral Phone no (Optional)') }}
            {{ html()->number('referral_phone_no')->placeholder('Enter referral phone no')->class('form-control') }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            {{ html()->label('Password') }}
            {{ html()->password('password')->placeholder('Enter password')->class('form-control ' . (isset($model) ? '' : 'requiredClass')) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            {{ html()->label('Address First Name (Optional)') }}
            {{ html()->text('address_first_name')->placeholder('Enter address first name')->class('form-control') }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            {{ html()->label('Address Last Name (Optional)') }}
            {{ html()->text('address_last_name')->placeholder('Enter address last name')->class('form-control') }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            {{ html()->label('Company Name (Optional)') }}
            {{ html()->text('company_name')->placeholder('Enter company name (optional)')->class('form-control') }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            {{ html()->label('Address Phone no (Optional)') }}
            {{ html()->text('address_phone_no')->placeholder('Enter address phone no')->class('form-control') }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            {{ html()->label('Address Email (Optional)') }}
            {{ html()->email('address_email')->placeholder('Enter address email')->class('form-control') }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            {{ html()->label('Postcode (Optional)') }}
            {{ html()->text('postcode')->placeholder('Enter city')->class('form-control') }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            {{ html()->label('City (Optional)') }}
            {{ html()->text('city')->placeholder('Enter city')->class('form-control') }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            {{ html()->label('State (Optional)') }}
            {{ html()->text('state')->placeholder('Enter state')->class('form-control') }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            {{ html()->label('Country (Optional)') }}
            {{ html()->select('country_id')->options([null => ''] + $countryDropdown)->class('form-control') }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            {{ html()->label('Address (Optional)') }}
            {{ html()->text('address')->placeholder('Enter address')->class('form-control') }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            {{ html()->label('Status') }}
            {{ html()->select('status')->options(renderSelect(Admin::STATUS))->class('form-control') }}
        </div>
    </div>
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