<table class="table table-striped border">
    <tbody >
        <tr>
            <tr>
                <td scope="col">{{__('page.name')}}</td>
            </tr>
            <tr>
                <td>
                    {{ html()->text('language[en][name]')->value(isset($model) && $model->enBlogDetail ? $model->enBlogDetail->name : "")->placeholder('Enter name')->class('form-control')->required() }}
                </td>
            </tr>
            <tr>
                <td scope="col">{{__('page.image')}}</td>
            </tr>
            <tr>
                <td scope="col">
                    {{ html()->file('language[en][image]')->accept('image/*')->class('form-control')->required(isset($model) && $model->enBlogDetail ? false : true)}}
                    {{ html()->hidden('language[en][original_image]')->value(isset($model) && $model->enBlogDetail ? $model->enBlogDetail->image : '') }}
                    <div class="text-center my-2">
                        <img class="img-fluid" {{isset($model) && $model->enBlogDetail ? 'src='.$model->enBlogDetail->image : ''}} />
                    </div>
                </td>
            </tr>
            <tr>
                <td scope="col">{{__('page.description')}}</td>
            </tr>
            <tr>
                <td>
                    {{ html()->textarea('language[en][content]')->value(isset($model) && $model->enBlogDetail ? $model->enBlogDetail->content : "")->class('form-control wysiwyg') }}
                </td>
            </tr>
        </tr>
    </tbody>
</table>