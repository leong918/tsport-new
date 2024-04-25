<x-alert />
<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            {{ html()->label('Level') }}
            {{ html()->select('level_id')->options($levelDropdown)->class('form-control') }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            {{ html()->label('Level Validity') }}
            <div class="input-group datePicker" data-td-target-input="nearest"
                data-td-target-toggle="nearest">
                <input id="levelValidityDatePicker" type="datetime" class="form-control" name="level_validity"
                    data-td-target="#dob" data-td-toggle="datetimepicker" 
                    value="{{ isset($model) &&  isset($model->level_validity)  ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $model->level_validity)->format('d/m/Y') : null }}"/>
            </div>
        </div>
    </div>
</div>

@section('script')
@parent
<script>
    $(document).ready(function() { 
        $('#levelValidityDatePicker').tempusDominus({
                localization: {
                    format: 'dd/MM/yyyy'
                }
            });
        });
</script>
@endsection