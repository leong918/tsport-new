<table class="table table-striped border">
    <thead>
        <tr>
            <th scope="col">{{__('page.name')}}</th>
            <th scope="col">{{__('page.description')}}</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                {{ html()->text('language[cn][name]')->value(isset($model) && $model->cnDescription ? $model->cnDescription->name : "")->placeholder('Enter name')->class('form-control')->required() }}
            </td>
            <td>
                {{ html()->textarea('language[cn][description]')->value(isset($model) && $model->cnDescription ? $model->cnDescription->description : "")->class('form-control wysiwyg') }}
            </td>
        </tr>
    </tbody>
</table>