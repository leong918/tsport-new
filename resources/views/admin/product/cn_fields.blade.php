<div class="row">
    <div class="col-md-12">
        <div class="mb-3">
            {{ html()->label('Name') }}
            {{ html()->text('language[en][name]')->value(isset($model) && $model->enDescription ? $model->enDescription->name : "")->placeholder('Enter name')->class('form-control')->required() }}
        </div>
    </div>
    <div class="col-md-12">
        <div class="mb-3">
            {{ html()->label('Information') }}
            {{ html()->textarea('language[cn][information]')->value(isset($model) && $model->cnDescription ? $model->cnDescription->information : "")->class('form-control wysiwyg') }}
        </div>
    </div>
    <div class="col-md-12">
        <div class="mb-3">
            {{ html()->label('Description') }}
            {{ html()->textarea('language[cn][description]')->value(isset($model) && $model->cnDescription ? $model->cnDescription->description : "")->class('form-control wysiwyg') }}
        </div>
    </div>
    <div class="col-md-12">
        <div class="mb-3">
            {{ html()->label('Ingredient') }}
            {{ html()->textarea('language[cn][ingredient]')->value(isset($model) && $model->cnDescription ? $model->cnDescription->ingredient : "")->class('form-control wysiwyg') }}
        </div>
    </div>
    <div class="col-md-12">
        <div class="mb-3">
            {{ html()->label('Usage') }}
            {{ html()->textarea('language[cn][usage]')->value(isset($model) && $model->cnDescription ? $model->cnDescription->usage : "")->class('form-control wysiwyg') }}
        </div>
    </div>
    <div class="col-md-12">
        <div class="mb-3">
            {{ html()->label('Additional Information') }}
            {{ html()->textarea('language[cn][additional_information]')->value(isset($model) && $model->cnDescription ? $model->cnDescription->additional_information : "")->class('form-control wysiwyg') }}
        </div>
    </div>
</div>