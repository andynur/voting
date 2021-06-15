<!doctype html>
<html lang="{{ htmlLang() }}" @langrtl dir="rtl" @endlangrtl>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ appName() }} | @yield('title')</title>
    @yield('meta')
    <link href="{{ mix('css/backend.css') }}" rel="stylesheet">
    <style>
        .form-control {
            height: calc(2em + 0.75rem + 2px);
        }

        .logo {
            display: block;
            margin: 0 auto;
            height: 15rem;
        }

        @media (max-width: 576px) {
            .logo {
                height: 11rem;
            }
        }
    </style>
    <livewire:styles />
    @stack('after-styles')
</head>
<body class="c-app flex-row align-items-center">
    <div class="container">
        <img src="{{ asset('img/logo.png') }}" alt="logo" class="logo">

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mx-4">
                    <div class="card-body text-center p-4">
                        <h2>E-VOTE KONDA2 BALIKPAPAN</h2>
                        <h4 class="text-muted mb-4">17-18 Juni 2021</h4>

                        @yield('content')
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>

    @stack('before-scripts')
    <script src="{{ mix('js/manifest.js') }}"></script>
    <livewire:scripts />
    @stack('after-scripts')
</body>
</html>
