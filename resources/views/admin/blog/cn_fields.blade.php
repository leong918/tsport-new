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
                <td scope="col">{{__('page.image')}}</td>
            </tr>
            <tr>
                <td scope="col">
                    {{ html()->file('language[cn][image]')->accept('image/*')->class('form-control')->required( isset($model) && $model->getParameters('cn') ? false : true)}}
                    {{ html()->hidden('language[cn][original_image]')->value(isset($model) && $model->getParameters('cn') ? $model->getParameters('cn')->image : '') }}

                    <div class="text-center my-2">
                        <img class="img-fluid" {{isset($model) && $model->getParameters('cn') ? 'src='.$model->getParameters('cn')->image : ''}} />
                    </div>
                </td>
            </tr>
            <tr>
                <td scope="col">{{__('page.description')}}</td>
            </tr>
            <tr>
                <td>
                    {{ html()->textarea('language[cn][content]')->value(isset($model) && $model->getParameters('cn') ? $model->getParameters('cn')->content : "")->class('form-control wysiwyg') }}
                </td>
            </tr>
        </tr>
    </tbody>
</table>
