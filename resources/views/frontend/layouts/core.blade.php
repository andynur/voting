<!doctype html>
<html lang="{{ htmlLang() }}" @langrtl dir="rtl" @endlangrtl>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ appName() }} | @yield('title')</title>
    <link rel="shortcut icon" href=" {{ asset('img/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href=" {{ asset('img/favicon.ico') }}" type="image/x-icon">
    @yield('meta')
    <link href="{{ mix('css/backend.css') }}" rel="stylesheet">
    <style>
        .c-header {
            padding: 0 4rem;
        }
        .form-control {
            height: calc(2em + 0.75rem + 2px);
        }

        .logo {
            display: block;
            margin: 0 auto;
            height: 15rem;
        }

        @media (max-width: 576px) {
            .c-header {
                padding: 0;
            }
            .logo {
                height: 11rem;
            }
        }
    </style>
    @stack('after-styles')
</head>
<body class="c-app">
    @include('backend.includes.sidebar_guest')

    <div class="c-wrapper c-fixed-components">
        @include('backend.includes.header_guest')

        <div class="c-body">
            <main class="c-main">
                <div class="container-fluid">
                    <div class="fade-in">
                      @yield('content')
                    </div>
                </div>
            </main>
        </div>
    </div>

    @stack('before-scripts')
    <script src="{{ mix('js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    <script src="{{ mix('js/backend.js') }}"></script>
    @stack('after-scripts')
</body>
</html>
