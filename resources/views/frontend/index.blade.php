@extends('frontend.layouts.auth', ['hide_menu' => true])

@section('title', 'Beranda')

@section('content')
    <hr>
    <div class="row mt-4">
        <div class="col-12">
            @auth
                @if (auth()->user()->isUser())
                    <a href="{{route('frontend.voting')}}" class="btn btn-lg btn-success btn-block text-white mb-2"><i class="fas fa-check mr-2"></i>Voting</a>
                @else
                    <a href="{{route('admin.dashboard')}}" class="btn btn-lg btn-success btn-block text-white mb-2"><i class="fas fa-sign-in-alt mr-2"></i>Dashboard</a>
                @endif
            @endauth
        </div>
        <div class="col-12">
            @guest
                <a href="{{route('frontend.auth.login_member')}}" class="btn btn-lg btn-success btn-block text-white mb-1"><i class="fas fa-user mr-2"></i>Login Peserta</a>
            @endguest

            <a href="{{route('frontend.live-polling')}}" class="btn btn-lg btn-info btn-block text-white mb-1"><i class="fas fa-balance-scale mr-2"></i>Lihat Live Polling</a>

            @auth
                <x-utils.link
                    class="btn btn-lg btn-danger btn-block text-white mb-1"
                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <x-slot name="text">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        <x-forms.post :action="route('frontend.auth.logout')" id="logout-form" class="d-none" />
                    </x-slot>
                </x-utils.link>
            @endauth
        </div>
    </div>
@endsection
