<div class="c-sidebar c-sidebar-dark c-sidebar-fixed" id="sidebar">
    <div class="c-sidebar-brand">
        <img src="{{asset('img/logo-text.png')}}" width="118" height="46" class="img-fluid c-sidebar-brand-full">
        <img src="{{asset('img/logo.png')}}" width="30" class="img-fluid c-sidebar-brand-minimized">
    </div><!--c-sidebar-brand-->

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <x-utils.link
                class="c-sidebar-nav-link"
                :href="route('frontend.index')"
                :active="activeClass(Route::is('frontend.index'), 'c-active')"
                icon="c-sidebar-nav-icon cil-home"
                :text="__('Home')" />
        </li>
        @if (auth()->check() && auth()->user()->isUser())
            <li class="c-sidebar-nav-item">
                <x-utils.link
                    class="c-sidebar-nav-link"
                    :href="route('frontend.voting')"
                    :active="activeClass(Route::is('frontend.voting'), 'c-active')"
                    icon="c-sidebar-nav-icon cil-check"
                    :text="__('Voting')" />
            </li>
        @endif
        <li class="c-sidebar-nav-item">
            <x-utils.link
                class="c-sidebar-nav-link"
                :href="route('frontend.live-polling')"
                :active="activeClass(Route::is('frontend.live-polling'), 'c-active')"
                icon="c-sidebar-nav-icon cil-balance-scale"
                :text="__('Live Polling')" />
        </li>
    </ul>
</div>
