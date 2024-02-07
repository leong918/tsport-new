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
            {{ html()->label('DOB') }}
            <div class="input-group" id="datetimepicker1" data-td-target-input="nearest" data-td-target-toggle="nearest">
                <input id="datetimepicker1Input" type="text" name="dob" class="form-control" data-td-target="#datetimepicker1" required/>
                <span class="input-group-text" data-td-target="#datetimepicker1" data-td-toggle="datetimepicker">
                    <span class="fas fa-calendar"></span>
                </span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            {{ html()->label('Referral Email') }}
            {{ html()->text('referral_email')->placeholder('Enter referral email')->class('form-control')->required() }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            {{ html()->label('Referral Phone no') }}
            {{ html()->text('referral_phone_no')->placeholder('Enter referral phone no')->class('form-control')->required() }}
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@eonasdan/tempus-dominus@6.7.10/dist/js/tempus-dominus.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@eonasdan/tempus-dominus@6.7.10/dist/js/jQuery-provider.js"></script>
<script>
    var dateString = '{{ isset($model) && $model->dob ? $model->dob : '' }}'; 
    if(dateString){
        var date = new Date(dateString);
    }else{
        var date = new Date();
    }

    var day = date.getDate();
    var month = date.getMonth() + 1; 
    var year = date.getFullYear();
    var dob = (day < 10 ? '0' : '') + day + '/' + (month < 10 ? '0' : '') + month + '/' + year;

    $(document).ready(function() { 
        $('#datetimepicker1').tempusDominus({
            defaultDate: dob,
            localization: {
                format: 'dd/MM/yyyy',
            },
            display:{
                theme: 'light',
                components: {
                    clock: false,
                },
            },
        });
    });
</script>
@endsection