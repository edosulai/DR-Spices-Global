<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('storage/images/favicon.png') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito">
    <link href="https://fonts.googleapis.com/css?family=Raleway|Rock+Salt|Source+Code+Pro:300,400,600" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script id="midtrans-script" type="text/javascript" src="https://api.midtrans.com/v2/assets/js/midtrans-new-3ds.min.js" data-environment="sandbox" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>

    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    @livewireStyles

    <script src="{{ mix('js/head.js') }}"></script>
</head>

<body>
    {{ $slot }}

    <x-pre-loader />

    <div class="modal fade" tabindex="-1" id="logoutModal" aria-labelledby="logoutModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Ready to Leave?') }}</h5>
                </div>
                <div class="modal-body p-4">
                    <i>{{ __('Select "Logout" below if you are ready to end your current session.') }}</i>
                </div>
                <div class="modal-footer bg-light">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    <form method="POST" id="logout-form" action="{{ route('logout') }}">@csrf</form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ mix('js/app.js') }}" defer></script>

    @livewireScripts
</body>

</html>
