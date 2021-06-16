@extends('frontend.layouts.auth', ['hide_menu' => true])

@section('title', 'Login Peserta')

@section('content')
    <x-forms.post :action="route('frontend.auth.login')">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="c-icon cil-lock-locked mr-1"></i> PIN
                </span>
            </div>
            <input class="form-control" name="pin" type="text" placeholder="KODE PIN PESERTA" value="{{ request()->pin ?? '' }}">
        </div>
        @if($errors->any())
            <p class="text-danger text-center font-weight-bold text-uppercase">{{$errors->first()}}</p>
        @endif
        <button class="btn btn-lg btn-block btn-success" type="submit">Login</button>
        {{-- <div class="text-center mt-3">
            <a href="{{ url('/') }}">Kembali ke Beranda</a>
        </div> --}}
    </x-forms.post>
@endsection
