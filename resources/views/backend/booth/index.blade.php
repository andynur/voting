@extends('backend.layouts.app')

@section('title', __('Bilik Suara'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Kotak Suara')
        </x-slot>
        <x-slot name="body">
            <table class="table table-datatable">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Pemilih</th>
                        <th>Pilihan</th>
                        <th>Waktu Memilih</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($votes as $vote)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$vote->voter->user->name}}</td>
                            <td>{{$vote->candidate->name}}</td>
                            <td>{{$vote->voter->selected_date->format('d-m-Y H:m:s')}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-slot>
    </x-backend.card>
@endsection
