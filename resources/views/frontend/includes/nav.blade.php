<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="@lang('Toggle navigation')">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <x-utils.link
                        :href="route('frontend.index')"
                        :active="activeClass(Route::is('frontend.index'))"
                        :text="__('Home')"
                        class="nav-link" />
                </li>
                @if (auth()->check() && auth()->user()->isUser()) {
                    <li class="nav-item">
                        <x-utils.link
                            :href="route('frontend.voting')"
                            :active="activeClass(Route::is('frontend.voting'))"
                            :text="__('Voting')"
                            class="nav-link" />
                    </li>
                @endif
                <li class="nav-item">
                    <x-utils.link
                        :href="route('frontend.live-polling')"
                        :active="activeClass(Route::is('frontend.live-polling'))"
                        :text="__('Live Polling')"
                        class="nav-link" />
                </li>
            </ul>
            @auth
                <span class="navbar-text">
                    {{ $logged_in_user->name }}
                </span>
            @endauth
        </div><!--navbar-collapse-->
    </div><!--container-->
</nav>
