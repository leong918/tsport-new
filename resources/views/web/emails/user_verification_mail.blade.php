@component('mail::layout')

    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            <img src="{{asset('assets/web/assets/img/global/logo.png')}}" style="width:auto" class="logo" alt="Tag Concept Logo">
        @endcomponent
    @endslot

    <div style="">
        <p><b>Hello!</b></p>
        <p>Please click the button below to verify your email address.</p>
        <x-mail::button :url="$verificationUrl">
            Verify Email Address
        </x-mail::button>
        <p>If you did not create an account, no further action is required.</p>
    </div>

    @slot('subcopy')
        @component('mail::subcopy')
            <p>If you're having trouble clicking the "Verify Email Address" button, copy and paste the verificationUrl below into your web browser: <span style="word-break: break-all;"><a href="{{ $verificationUrl }}">{{ $verificationUrl }}</a></span></p>
            <p>Thanks,<br/> Tag Concept</p>
        @endcomponent
    @endslot

    @slot('footer')
        @component('mail::footer')
        <div style="background-color:black; margin:-32px !important; padding: 15px 0px;">
            <div style="text-align: center; font-size:10px; color:white; margin:15px 0px">
                Tag Concept 
            </div>
            <div style="display:flex; justify-content: center; ">
                <a href="https://www.facebook.com/tagconcept" style="padding:5px; font-size:13px; border-radius:10px;">
                    <img src="{{asset('assets/web/assets/img/global/fb.png')}}" style="width:30px; height:30px; border-radius:30px; object-fit:cover" class="logo" alt="Facebook Logo">
                </a>
                <a href="https://www.instagram.com/tagconcept" style="padding:5px; font-size:13px; border-radius:10px;">
                    <img src="{{asset('assets/web/assets/img/global/ig.png')}}" style="width:30px; height:30px; border-radius:30px; object-fit:cover" class="logo" alt="Instagram Logo">
                </a>
            </div>
        </div>
        @endcomponent
    @endslot

@endcomponent
