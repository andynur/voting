@extends('backend.layouts.app')

@section('title', __('Bilik Suara'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Hitung Cepat')
        </x-slot>
        <x-slot name="body">
            <div class="row candidate-container">
                @foreach ($candidates as $candidate)
                <div class="col-md-4 col-lg-4 col-sm-12">
                    <div class="card card-img-box align-items-center pt-2">
                        <img class="card-img-top" src="{{asset($candidate->profile_image)}}" alt="Card image cap">
                        <div class="card-body text-center p-2">

                        </div>
                        <div class="w-100 text-center py-3" style="background: {{$colors[$loop->iteration - 1]}}">
                            <h3 class="card-title text-white mb-1">#{{$loop->iteration}}</h3>
                            <h5 class="card-title text-white mb-1">{{$candidate->name}}</h5>
                            <h1 class="text-white">{{ $candidate->votes() }} Suara</h1>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </x-slot>
    </x-backend.card>
@endsection


@push('after-styles')
    <style>
        .card-img-box {
            background: #f7f7f7;
        }
        .card-img-top {
            width: 12rem;
        }

        .
    </style>
@endpush
