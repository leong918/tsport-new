<table class="table table-striped border">
    <thead>
        <tr>
            <th scope="col">{{__('page.name')}}</th>
            <th scope="col">{{__('page.description')}}</th>
        </tr>
    </thead>
    <tbody >
        <tr>
            <tr>
                <td>
                    {{ html()->text('language[en][name]')->value(isset($model) && $model->getParameters('en') ? $model->getParameters('en')->name : "")->placeholder('Enter name')->class('form-control')->required() }}
                </td>
                <td>
                    {{ html()->textarea('language[en][description]')->value(isset($model) && $model->getParameters('en') ? $model->getParameters('en')->description : "")->class('form-control wysiwyg') }}
                </td>
            </tr>
        </tr>
    </tbody>
</table>