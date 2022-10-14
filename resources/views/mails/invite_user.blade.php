@component('mail::layout')
    @slot ('header')
    {{-- Header default laravel --}}
        @component('mail::header', ['url' => "https://mindcloud.com"])
            Laravel
        @endcomponent
    @endslot
    
    <p>Hi,</p>
    <p>Someone has invited you to access their account.</p>
    @component('mail::button', ['url' => route('invites.index', ['token' => $invite->token, 'email' => $invite->email]), 'color' => 'green'])
        Accept invite
    @endcomponent
    @slot ('footer')
        @component('mail::footer')
            <p stype="text-align:center">&copy; Coppyright 2022 - MincCloud</p>
        @endcomponent
    @endslot
@endcomponent