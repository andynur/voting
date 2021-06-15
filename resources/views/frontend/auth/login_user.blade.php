@extends('frontend.layouts.app')

@section('title', __('Login'))

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-4 col-sm-10 col-lg-4 mt-4 pt-4">
              <div class="title m-b-md text-center">
                <img src="{{asset('img/logo.png')}}" style="height: 20rem" alt="" class="img-fluid">
                <h2 class="font-weight-bold">E-Vote Konda2 Balikpapan</h2>
                <h2 class="mb-4">17-18 Juni 2021</h2>
              </div>
              <x-frontend.card>
                <x-slot name="body">
                  <x-forms.post :action="route('frontend.auth.login')">
                    <div class="form-group">
                      <input type="text" name="pin" id="pin" class="form-control" placeholder="NOMOR PIN" value="{{ old('pin') }}" maxlength="20" required autofocus autocomplete="pin" />
                    </div><!--form-group-->
                    <button class="btn btn-primary btn-block" type="submit">@lang('Login')</button>
                  </x-forms.post>
                </x-slot>
              </x-frontend.card>
            </div><!--col-md-8-->
        </div><!--row-->
    </div><!--container-->
@endsection
