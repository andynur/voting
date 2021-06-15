@inject('model', '\App\Domains\Auth\Models\User')

@extends('backend.layouts.app')

@section('title', __('Data Peserta'))

@section('content')
    <x-forms.patch :action="route('admin.notification.update', $user)">
        <x-backend.card>
            <x-slot name="header">
                @lang('Form Data Peserta')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.notification.index')" :text="__('Batal')" />
            </x-slot>

            <x-slot name="body">
                <div x-data="{userType : '{{ $user->type }}'}">
                    <input type="hidden" name="type" value="{{ $user->type }}">
                    <input type="hidden" name="email" value="{{ $user->email }}">
                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label">@lang('Nama Lengkap')</label>

                        <div class="col-md-10">
                            <input type="text" name="name" class="form-control" placeholder="{{ __('Name') }}" value="{{ old('name') ?? $user->name }}" maxlength="100" required />
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="pin" class="col-md-2 col-form-label">@lang('Kode PIN')</label>

                        <div class="col-md-10">
                            <input type="text" name="pin" class="form-control" placeholder="{{ __('pin') }}" value="{{ old('pin') ?? $user->pin }}" required />
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="wa" class="col-md-2 col-form-label">@lang('Nomor WA')</label>

                        <div class="col-md-10">
                            <input type="text" name="wa" class="form-control" placeholder="{{ __('wa') }}" value="{{ old('wa') ?? $user->wa }}" required />
                            <p class="text-muted"><small>Note: Nomor WA pastikan sudah diawali <b>+62</b> dan tanpa spasi atau simbol - (minus)</small></p>
                        </div>
                    </div><!--form-group-->
                </div>
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-lg btn-block btn-info" type="submit">@lang('Simpan Perubahan')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.patch>
@endsection
