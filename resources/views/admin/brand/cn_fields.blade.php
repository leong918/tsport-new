<div>
    <table class="table table-striped border">
        <thead>
            <tr>
                <th scope="col">{{__('page.name')}}</th>
                <th scope="col">{{__('page.description')}}</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                @if(isset($model))
                <td>
                    {{ html()->text('language[cn][name]')->value($model->cnDescription->name)->placeholder('Enter name')->class('form-control')->required() }}
                </td>
                <td>
                    {{ html()->textarea('language[cn][description]')->value($model->cnDescription->description)->class('form-control wysiwyg') }}
                </td>
                @else
                <td>
                    {{ html()->text('language[cn][name]')->placeholder('Enter name')->class('form-control')->required() }}
                </td>
                <td>
                    {{ html()->textarea('language[cn][description]')->class('form-control wysiwyg') }}
                </td>
                @endif
            </tr>
        </tbody>
    </table>
</div>
