@extends('frontend.layouts.auth', ['hide_menu' => true])

@section('title', 'Beranda')

@section('content')
    <hr>
    <div class="row mt-4">
        <div class="col-12">
            @auth
                <a href="{{route('frontend.voting')}}" class="btn btn-lg btn-success btn-block text-white mb-2"><i class="fas fa-check mr-2"></i>Voting</a>
            @endauth
        </div>
        <div class="col-12">
            @auth
                {{-- <a href="#" class="btn btn-lg btn-danger btn-block text-white mb-2"><i class="fas fa-sign-out-alt mr-2"></i>Logout</a> --}}

                <x-utils.link
                    class="btn btn-lg btn-danger btn-block text-white"
                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <x-slot name="text">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        <x-forms.post :action="route('frontend.auth.logout')" id="logout-form" class="d-none" />
                    </x-slot>
                </x-utils.link>
            @else
                <a href="{{route('frontend.auth.login_member')}}" class="btn btn-lg btn-success btn-block text-white"><i class="fas fa-user mr-2"></i>Login Peserta</a>
            @endif
        </div>
        <div class="col-12">
            <a href="{{route('frontend.live-polling')}}" class="btn btn-lg btn-info btn-block text-white mt-2"><i class="fas fa-balance-scale mr-2"></i>Lihat Live Polling</a>
        </div>
    </div>
@endsection
