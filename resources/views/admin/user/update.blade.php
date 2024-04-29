@extends('admin.layout.app')

@section('style')
    @parent
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@eonasdan/tempus-dominus@6.7.10/dist/css/tempus-dominus.css"/>
@endsection

@section("content")
<main class="c-main">
    <div class="container-fluid">
        <x-alert />
        <div id="userErrorAlertContainer" class="alert alert-danger" style="display:none" role="alert"></div>
        <div class="fade-in">
            <div class="row">
                <div class="col-sm-12">
                    {{ html()->model($model)->form('PUT', route("admin.user.update.put", ["id" => $model->id]))->id("user")->open() }}
                    <div class="card mb-3">
                        <div class="card-header"><strong>User Level</strong> </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    @include("admin.user.level_fields")
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-header"><strong>User Info</strong> </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    @include("admin.user.fields")

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 float-end">
                        <a href="{{ route("admin.user.index") }}" class="btn btn-warning">Cancel</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    {{ html()->form()->close() }}
                    </div>
                </div>
                <!-- /.col-->

            </div>
        </div>
    </div>
</main>
@endsection

@section('script')
@parent
<script>
        $("#user").submit(function(e) {
            e.preventDefault();

            var requiredFields = $(this).find('.requiredClass');
            
            var emptyFields = requiredFields.filter(function() {
                return $(this).val() === '';
            });
            if(emptyFields.length > 0){
                var errorMessage = '';
                emptyFields.each(function()
                {
                    var fields = $(this).attr('name').replace(/_/g, ' ');
                    errorMessage += 'The <span style="font-family:RecklessNeue-Medium">'+fields+'</span> fields is required. <br/>';
                });
                $('#userErrorAlertContainer').html(errorMessage).show();
                // Scroll to the top of the page
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }else{
                $('#userErrorAlertContainer').hide();

                //submit
                $(this).off('submit').submit();
            }
        });
    </script>
@endsection