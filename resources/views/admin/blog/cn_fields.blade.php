<table class="table table-striped border">
    <tbody >
        <tr>
            <tr>
                <td scope="col">{{__('page.name')}}</td>
            </tr>
            <tr>
                <td>
                    {{ html()->text('language[cn][name]')->value(isset($model) && $model->cnBlogDetail ? $model->cnBlogDetail->name : "")->placeholder('Enter name')->class('form-control')->required() }}
                </td>
            </tr>
            <tr>
                <td scope="col">{{__('page.image')}}</td>
            </tr>
            <tr>
                <td scope="col">
                    {{ html()->file('language[cn][image]')->accept('image/*')->class('form-control')->required( isset($model) && $model->cnBlogDetail ? false : true)}}
                    {{ html()->hidden('language[cn][original_image]')->value(isset($model) && $model->cnBlogDetail ? $model->cnBlogDetail->image : '') }}

                    <div class="text-center my-2">
                        <img class="img-fluid" {{isset($model) && $model->cnBlogDetail ? 'src='.$model->cnBlogDetail->image : ''}} />
                    </div>
                </td>
            </tr>
            <tr>
                <td scope="col">{{__('page.description')}}</td>
            </tr>
            <tr>
                <td>
                    {{ html()->textarea('language[cn][content]')->value(isset($model) && $model->cnBlogDetail ? $model->cnBlogDetail->content : "")->class('form-control wysiwyg') }}
                </td>
            </tr>
        </tr>
    </tbody>
</table>
