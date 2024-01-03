<div class="form-group text-center">
    <img src="{{Captcha::src('flat')}}" class="img-fluid captcha-img" />
    <span id="refresh" style="margin-left: 20px; cursor: pointer;">
        <i class="fa fa-refresh"></i>
    </span>
</div>

<div class="form-group ">
    <input type="text" style="text-transform: none;" name="captcha" value="{{ old('captcha') }}" required
        placeholder="{{ __("page.captcha") }}" class="form-control">
</div>

@section('script')
@parent
<script type="text/javascript">
    $(document).ready(function() {
        $('#refresh').on('click', function () {
            var captcha = $('img.captcha-img');
            var config = captcha.data('refresh-config');
            axios.get('{{ route('captcha') }}')
                .then((response) => {
                    captcha.prop('src', response.data);
                })
      });
    });
</script>
@endsection