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
            {{ html()->textarea('language[en][information]')->value(isset($model) && $model->enDescription ? $model->enDescription->information : "")->class('form-control wysiwyg') }}
        </div>
    </div>
    <div class="col-md-12">
        <div class="mb-3">
            {{ html()->label('Description') }}
            {{ html()->textarea('language[en][description]')->value(isset($model) && $model->enDescription ? $model->enDescription->description : "")->class('form-control wysiwyg') }}
        </div>
    </div>
    <div class="col-md-12">
        <div class="mb-3">
            {{ html()->label('Ingredient') }}
            {{ html()->textarea('language[en][ingredient]')->value(isset($model) && $model->enDescription ? $model->enDescription->ingredient : "")->class('form-control wysiwyg') }}
        </div>
    </div>
    <div class="col-md-12">
        <div class="mb-3">
            {{ html()->label('Usage') }}
            {{ html()->textarea('language[en][usage]')->value(isset($model) && $model->enDescription ? $model->enDescription->usage : "")->class('form-control wysiwyg') }}
        </div>
    </div>
    <div class="col-md-12">
        <div class="mb-3">
            {{ html()->label('Additional Information') }}
            {{ html()->textarea('language[en][additional_information]')->value(isset($model) && $model->enDescription ? $model->enDescription->additional_information : "")->class('form-control wysiwyg') }}
        </div>
    </div>
</div>