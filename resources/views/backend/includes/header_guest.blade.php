<header class="c-header c-header-light c-header-fixed">
    <button class="c-header-toggler c-class-toggler d-lg-none mfe-auto" type="button" data-target="#sidebar" data-class="c-sidebar-show">
        <i class="c-icon c-icon-lg cil-menu"></i>
    </button>

    <a class="c-header-brand d-lg-none" href="#">
        <img src="{{asset('img/logo-black.png')}}" width="80" class="img-fluid c-sidebar-brand-full">
    </a>

    <ul class="c-header-nav d-md-down-none">
        <li class="c-header-nav-item px-3"><a class="c-header-nav-link" href="{{ route('frontend.index') }}">Home</a></li>
        @if (auth()->check() && auth()->user()->isUser())
            <li class="c-header-nav-item px-3"><a class="c-header-nav-link" href="{{ route('frontend.voting') }}">Voting</a></li>
        @endif
        <li class="c-header-nav-item px-3"><a class="c-header-nav-link" href="{{ route('frontend.live-polling') }}">Live Polling</a></li>
    </ul>

    <ul class="c-header-nav ml-auto mr-2">
        <li class="c-header-nav-item dropdown">
            <x-utils.link class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <x-slot name="text">
                    <div class="c-avatar">
                        <img class="c-avatar-img" src="https://gravatar.com/avatar/x?s=80&d=mp" alt="avatar">
                    </div>
                    @auth
                        <span class="ml-2 mr-3 d-none d-sm-block">{{ $logged_in_user->name }}</span>
                    @endauth
                </x-slot>
            </x-utils.link>

            <div class="dropdown-menu dropdown-menu-right pt-0">
                <div class="dropdown-header bg-light py-2">
                    <strong>@lang('Account')</strong>
                </div>

                @auth
                    <x-utils.link
                        class="dropdown-item"
                        icon="c-icon mr-2 cil-account-logout"
                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <x-slot name="text">
                            @lang('Logout')
                            <x-forms.post :action="route('frontend.auth.logout')" id="logout-form" class="d-none" />
                        </x-slot>
                    </x-utils.link>
                @else
                    <x-utils.link
                        href="{{ route('frontend.auth.login') }}"
                        class="dropdown-item"
                        icon="c-icon mr-2 cil-lock-unlocked">
                        <x-slot name="text">Login Admin</x-slot>
                    </x-utils.link>
                    <x-utils.link
                        href="{{ route('frontend.auth.login_member') }}"
                        class="dropdown-item"
                        icon="c-icon mr-2 cil-user">
                        <x-slot name="text">Login Peserta</x-slot>
                    </x-utils.link>
                @endauth
            </div>
        </li>
    </ul>
</header>
