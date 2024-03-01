<table class="table table-striped border">
    <tbody >
        <tr>
            <tr>
                <td scope="col">{{__('page.name')}}</td>
            </tr>
            <tr>
                <td>
                    {{ html()->text('language[en][name]')->value(isset($model) && $model->getParameters('en') ? $model->getParameters('en')->name : "")->placeholder('Enter name')->class('form-control')->required() }}
                </td>
            </tr>
            <tr>
                <td scope="col">{{__('page.image')}}</td>
            </tr>
            <tr>
                <td scope="col">
                    {{ html()->file('language[en][image]')->accept('image/*')->class('form-control')->required(isset($model) && $model->getParameters('en') ? false : true)}}
                    {{ html()->hidden('language[en][original_image]')->value(isset($model) && $model->getParameters('en') ? $model->getParameters('en')->image : '') }}
                    <div class="text-center my-2">
                        <img class="img-fluid" {{isset($model) && $model->getParameters('en') ? 'src='.$model->getParameters('en')->image : ''}} />
                    </div>
                </td>
            </tr>
            <tr>
                <td scope="col">{{__('page.description')}}</td>
            </tr>
            <tr>
                <td>
                    {{ html()->textarea('language[en][content]')->value(isset($model) && $model->getParameters('en') ? $model->getParameters('en')->content : "")->class('form-control wysiwyg') }}
                </td>
            </tr>
        </tr>
    </tbody>
</table>