@extends('backend.layouts.app')

@section('title', __('Bilik Suara'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Hitung Cepat')
        </x-slot>
        <x-slot name="body">
            <table class="table table-datatable">
                <thead>
                    <tr>
                        <th>No. Urut</th>
                        <th>Nama Kandidat</th>
                        <th>Foto Kandidat</th>
                        <th>Jumlah Suara</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($candidates as $candidate)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$candidate->name}}</td>
                            <td>
                              <img class="img-fluid" width="150px" src="{{asset($candidate->profile_image)}}" alt="">
                            </td>
                            <td>{{$candidate->votes()}} Suara</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-slot>
    </x-backend.card>
@endsection
