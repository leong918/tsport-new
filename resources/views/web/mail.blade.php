
@component('mail::layout')

    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            <img src="{{asset('assets/web/assets/img/header/logo.png')}}" style="width:auto" class="logo" alt="Hellosmile Logo">
        @endcomponent
    @endslot

    <div style="font-size:14px;">
        First Name: {{ $first_name }}<br/>
        Last Name: {{ $last_name }}<br/>
        Email: {{ $email }}<br/>
        Message: {{ $message }}<br/>
    </div>

    @slot('footer')
        @component('mail::footer')
        <div style="background-color:white; margin:-32px !important; padding: 15px 0px;">
            <div style="text-align: center; font-size:10px; margin:15px 0px">
                Sample Project
            </div>
        </div>
        @endcomponent
    @endslot
    
@endcomponent