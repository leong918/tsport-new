<div>
    <table class="table table-striped border">
        <tbody >
            <tr>
                <tr>
                    {{-- <td scope="col">{{__('page.name')}}</td> --}}
                    <td scope="col">{{__('Name')}}</td>
                </tr>
                <tr>
                    <td>
                        {{ html()->text('language[en][name]')->value(isset($model) && $model->getParameters('en') ? $model->getParameters('en')->name : "")->placeholder('Enter name')->class('form-control')->required() }}
                    </td>
                </tr>
            </tr>
        </tbody>
    </table>
</div>