<div>
    <table class="table table-striped border">
        <tbody >
            <tr>
                <tr>
                    <td scope="col">{{__('page.name')}}</td>
                </tr>
                <tr>
                    <td>
                        {{ html()->text('language[cn][name]')->value(isset($model) && $model->getParameters('cn') ? $model->getParameters('cn')->name : "")->placeholder('Enter name')->class('form-control')->required() }}
                    </td>
                </tr>
                <tr>
                    <td scope="col">{{__('page.information')}}</td>
                </tr>
                <tr>
                    <td>
                        {{ html()->textarea('language[cn][information]')->value(isset($model) && $model->getParameters('cn') ? $model->getParameters('cn')->information : "")->class('form-control wysiwyg') }}
                    </td>
                </tr>
                <tr>
                    <td scope="col">{{__('page.description')}}</td>
                </tr>
                <tr>
                    <td>
                        {{ html()->textarea('language[cn][description]')->value(isset($model) && $model->getParameters('cn') ? $model->getParameters('cn')->description : "")->class('form-control wysiwyg') }}
                    </td>
                </tr>
                <tr>
                    <td scope="col">{{__('page.ingredient')}}</td>
                </tr>
                <tr>
                    <td>
                        {{ html()->textarea('language[cn][ingredient]')->value(isset($model) && $model->getParameters('cn') ? $model->getParameters('cn')->ingredient : "")->class('form-control wysiwyg') }}
                    </td>
                </tr>
                <tr>
                    <td scope="col">{{__('page.usage')}}</td>
                </tr>
                <tr>
                    <td>
                        {{ html()->textarea('language[cn][usage]')->value(isset($model) && $model->getParameters('cn') ? $model->getParameters('cn')->usage : "")->class('form-control wysiwyg') }}
                    </td>
                </tr>
                <tr>
                    <td scope="col">{{__('page.additional_information')}}</td>
                </tr>
                <tr>
                    <td>
                        {{ html()->textarea('language[cn][additional_information]')->value(isset($model) && $model->getParameters('cn') ? $model->getParameters('cn')->additional_information : "")->class('form-control wysiwyg') }}
                    </td>
                </tr>
            </tr>
        </tbody>
    </table>
</div>