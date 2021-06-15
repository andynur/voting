@extends('frontend.layouts.auth')

@section('title', 'Login Administrator')

@section('content')
    <x-forms.post :action="route('frontend.auth.login')">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="c-icon cil-user"></i>
                </span>
            </div>
            <input class="form-control" name="username" type="text" value="{{ old('username') }}" maxlength="20" placeholder="Username">
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="c-icon cil-lock-locked"></i>
                </span>
            </div>
            <input class="form-control" name="password"  type="password" placeholder="Password">
        </div>
        <button class="btn btn-lg btn-block btn-success" type="submit">Login</button>
        <div class="text-center mt-3">
            <a href="{{ url('/') }}">Kembali ke Beranda</a>
        </div>
    </x-forms.post>
@endsection
