<div>
    <table class="table table-striped border">
        <tbody >
            <tr>
                <tr>
                    <td scope="col">{{__('Name')}}</td>
                </tr>
                <tr>
                    <td>
                        {{ html()->text('language[cn][name]')->value(isset($model) && $model->getParameters('cn') ? $model->getParameters('cn')->name : "")->placeholder('Enter name')->class('form-control')->required() }}
                    </td>
                </tr>
                <tr>
                    <td scope="col">{{__('Description')}}</td>
                </tr>
                <tr>
                    <td>
                        {{ html()->textarea('language[cn][description]')->value(isset($model) && $model->getParameters('cn') ? $model->getParameters('cn')->description : "")->class('form-control wysiwyg') }}
                    </td>
                </tr>
            </tr>
        </tbody>
    </table>
</div>