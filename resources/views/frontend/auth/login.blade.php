@extends('frontend.layouts.app')

@section('title', __('Login'))

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-4 col-sm-10 col-lg-4 mt-4 pt-4" style="margin-top: 15%!important">
                <x-frontend.card>
                    <x-slot name="body">
                        <x-forms.post :action="route('frontend.auth.login')">
                            <div class="form-group">
                                <input type="email" name="email" id="email" class="form-control" placeholder="{{ __('E-mail Address') }}" value="{{ old('email') }}" maxlength="255" required autofocus autocomplete="email" />
                            </div><!--form-group-->

                            <div class="form-group">
                                <input type="password" name="password" id="password" class="form-control" placeholder="{{ __('Password') }}" maxlength="100" required autocomplete="current-password" />
                            </div><!--form-group-->
                            <button class="btn btn-primary btn-block" type="submit">@lang('Login')</button>
                        </x-forms.post>
                    </x-slot>
                </x-frontend.card>
            </div><!--col-md-8-->
        </div><!--row-->
    </div><!--container-->
@endsection
