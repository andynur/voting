<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ appName() }}</title>
        <meta name="description" content="@yield('meta_description', appName())">
        <meta name="author" content="@yield('meta_author', 'Anthony Rappa')">
        @yield('meta')

        @stack('before-styles')
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="{{ mix('css/frontend.css') }}" rel="stylesheet">
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
        @stack('after-styles')
    </head>
    <body>

        <div id="app" class="flex-center position-ref full-height">
            <div class="content">
                @include('includes.partials.messages')

                <div class="title m-b-md">
                    <img src="{{asset('img/logo.png')}}" style="height: 20rem" alt="" class="img-fluid">
                </div><!--title-->
                <h2 class="font-weight-bold">E-Vote Konda2 Balikpapan</h2>
                <h2 class="mb-4">17-18 Juni 2021</h2>
                <div class="links">
                    @auth
                        @if ($logged_in_user->isUser())
                            <a href="{{route('frontend.auth.login')}}" class="btn btn-success py-2 text-white"><i class="fas fa-sign-in-alt mr-2"></i>Dashboard</a>
                        @endif
                    @else
                        <a href="{{route('frontend.auth.login')}}" class="btn btn-success py-2 text-white"><i class="fas fa-sign-in-alt mr-2"></i>Login</a>
                    @endauth
                </div><!--links-->
            </div><!--content-->
        </div><!--app-->

        @stack('before-scripts')
        <script src="{{ mix('js/manifest.js') }}"></script>
        <script src="{{ mix('js/vendor.js') }}"></script>
        <script src="{{ mix('js/frontend.js') }}"></script>
        @stack('after-scripts')
    </body>
</html>
