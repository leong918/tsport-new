<div class="col-sm-12">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><strong>Chinese</strong></div>
                <div class="card-body">
                    <div>
                        <table class="table table-striped border">
                            <tbody >
                                <tr>
                                    <tr>
                                        <td scope="col">Name</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{ html()->text('language[cn][name]')->value(isset($model) && $model->getParameters('cn') ? $model->getParameters('cn')->name : "")->placeholder('Enter name')->class('form-control')->required() }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="col">Information</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{ html()->textarea('language[cn][information]')->value(isset($model) && $model->getParameters('cn') ? $model->getParameters('cn')->information : "")->class('form-control wysiwyg') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="col">Description</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{ html()->textarea('language[cn][description]')->value(isset($model) && $model->getParameters('cn') ? $model->getParameters('cn')->description : "")->class('form-control wysiwyg') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="col">Ingredient</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{ html()->textarea('language[cn][ingredient]')->value(isset($model) && $model->getParameters('cn') ? $model->getParameters('cn')->ingredient : "")->class('form-control wysiwyg') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="col">Usage</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{ html()->textarea('language[cn][usage]')->value(isset($model) && $model->getParameters('cn') ? $model->getParameters('cn')->usage : "")->class('form-control wysiwyg') }}
                                        </td>
                                    </tr>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>