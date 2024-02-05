{{-- <div> --}}
    <table class="table table-striped border">
        <thead>
            <tr>
                <th scope="col">{{__('page.name')}}</th>
                <th scope="col">{{__('page.description')}}</th>
            </tr>
        </thead>
        <tbody >
            <tr>
                @if(isset($model))
                <td>
                    {{ html()->text('language[en][name]')->value($model->enDescription->name)->placeholder('Enter name')->class('form-control')->required() }}
                </td>
                <td>
                    {{ html()->textarea('language[en][description]')->value($model->enDescription->description)->class('form-control wysiwyg') }}
                </td>
                @else
                <td>
                    {{ html()->text('language[en][name]')->placeholder('Enter name')->class('form-control')->required() }}
                </td>
                <td>
                    {{ html()->textarea('language[en][description]')->class('form-control wysiwyg') }}
                </td>
                @endif
            </tr>
        </tbody>
    </table>
</div>