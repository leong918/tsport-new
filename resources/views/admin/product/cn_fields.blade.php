<div>
    <table class="table table-striped border">
        <tbody >
            <tr>
                <tr>
                    <td scope="col">{{__('page.name')}}</td>
                </tr>
                <tr>
                    <td>
                        {{ html()->text('language[cn][name]')->value(isset($model) && $model->name ? $model->name : "")->placeholder('Enter name')->class('form-control')->required() }}
                    </td>
                </tr>
                <tr>
                    <td scope="col">{{__('page.information')}}</td>
                </tr>
                <tr>
                    <td>
                        {{ html()->textarea('language[cn][information]')->value(isset($model) && $model->cnDescription ? $model->cnDescription->information : "")->class('form-control wysiwyg') }}
                    </td>
                </tr>
                <tr>
                    <td scope="col">{{__('page.description')}}</td>
                </tr>
                <tr>
                    <td>
                        {{ html()->textarea('language[cn][description]')->value(isset($model) && $model->cnDescription ? $model->cnDescription->description : "")->class('form-control wysiwyg') }}
                    </td>
                </tr>
                <tr>
                    <td scope="col">{{__('page.ingredient')}}</td>
                </tr>
                <tr>
                    <td>
                        {{ html()->textarea('language[cn][ingredient]')->value(isset($model) && $model->cnDescription ? $model->cnDescription->ingredient : "")->class('form-control wysiwyg') }}
                    </td>
                </tr>
                <tr>
                    <td scope="col">{{__('page.usage')}}</td>
                </tr>
                <tr>
                    <td>
                        {{ html()->textarea('language[cn][usage]')->value(isset($model) && $model->cnDescription ? $model->cnDescription->usage : "")->class('form-control wysiwyg') }}
                    </td>
                </tr>
                <tr>
                    <td scope="col">{{__('page.additional_information')}}</td>
                </tr>
                <tr>
                    <td>
                        {{ html()->textarea('language[cn][additional_information]')->value(isset($model) && $model->cnDescription ? $model->cnDescription->additional_information : "")->class('form-control wysiwyg') }}
                    </td>
                </tr>
            </tr>
        </tbody>
    </table>
</div>