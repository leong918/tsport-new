<div>
    <table class="table table-striped border">
        <tbody >
            <tr>
                <tr>
                    <td scope="col">{{__('page.name')}}</td>
                </tr>
                <tr>
                    <td>
                        {{ html()->text('language[en][name]')->value(isset($model) && $model->name ? $model->name : "")->placeholder('Enter name')->class('form-control')->required() }}
                    </td>
                </tr>
                <tr>
                    <td scope="col">{{__('page.information')}}</td>
                </tr>
                <tr>
                    <td>
                        {{ html()->textarea('language[en][information]')->value(isset($model) && $model->enDescription ? $model->enDescription->information : "")->class('form-control wysiwyg') }}
                    </td>
                </tr>
                <tr>
                    <td scope="col">{{__('page.description')}}</td>
                </tr>
                <tr>
                    <td>
                        {{ html()->textarea('language[en][description]')->value(isset($model) && $model->enDescription ? $model->enDescription->description : "")->class('form-control wysiwyg') }}
                    </td>
                </tr>
                <tr>
                    <td scope="col">{{__('page.ingredient')}}</td>
                </tr>
                <tr>
                    <td>
                        {{ html()->textarea('language[en][ingredient]')->value(isset($model) && $model->enDescription ? $model->enDescription->ingredient : "")->class('form-control wysiwyg') }}
                    </td>
                </tr>
                <tr>
                    <td scope="col">{{__('page.usage')}}</td>
                </tr>
                <tr>
                    <td>
                        {{ html()->textarea('language[en][usage]')->value(isset($model) && $model->enDescription ? $model->enDescription->usage : "")->class('form-control wysiwyg') }}
                    </td>
                </tr>
                <tr>
                    <td scope="col">{{__('page.additional_information')}}</td>
                </tr>
                <tr>
                    <td>
                        {{ html()->textarea('language[en][additional_information]')->value(isset($model) && $model->enDescription ? $model->enDescription->additional_information : "")->class('form-control wysiwyg') }}
                    </td>
                </tr>
            </tr>
        </tbody>
    </table>
</div>