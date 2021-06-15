@extends('frontend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <x-frontend.card>
                    <x-slot name="header">
                        @lang('Pilih Vote')
                        <div class="mt-3">
                            <select name="" id="" class="form-control select2 election-select">
                                @foreach ($elections as $election)
                                    <option value="{{$election->id}}" {{$selected_election->id === $election->id ? 'selected' : ''}}>{{$election->election->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </x-slot>

                    <x-slot name="body">
                        <div class="row">
                            @if ($selected_election->has_elected != 1)
                                @foreach ($selected_election->election->candidates as $candidate)
                                <div class="col-md-4 col-lg-4 col-sm-12">
                                    <div class="card">
                                        <img class="card-img-top" src="{{asset($candidate->profile_image)}}" alt="Card image cap">
                                        <div class="card-body">
                                            <h5 class="card-title">{{$candidate->name}}</h5>
                                            <p class="card-text">
                                                {{$candidate->description}}
                                            </p>
                                            {{ html()->form('POST', route("frontend.user.dashboard.election", ['candidate_id' => $candidate->id, 'election_id' => $selected_election->id]))->class('form')->attributes(["enctype" => "multipart/form-data"])->open() }}
                                            {{ html()->button($text = "<i class='fas fa-edit mr-2'></i>Pilih", $type = 'submit')->class('btn btn-primary btn-block') }}
                                            {{ html()->form()->close() }}
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @else
                            <div class="jumbotron text-center w-100">
                                <i class="fas fa-check-circle fa-5x text-success"></i>
                                <h1 class="font-weight-bold mt-2 text-success">Anda sudah memilih!</h1>
                                
                                <p>Terima kasih karena telah menggunakan suara anda dengan bijaksana</p>
                            </div>
                            @endif
                        </div>
                    </x-slot>
                </x-frontend.card>
            </div>
        </div>
    </div>
@endsection
