@extends('backend.layouts.app')

@section('title', __('Bilik Suara'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Pilih Vote')
        </x-slot>
    </x-backend.card>
@endsection
