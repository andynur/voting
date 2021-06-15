@extends('backend.layouts.app')

@section('title', __('Bilik Suara'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Laporan')
        </x-slot>
        <x-slot name="body">
            <a href="{{route('admin.reports.export')}}" download class="btn btn-success">
              <i class="fas fa-download mr-2"></i>
              Download Laporan
            </a>
        </x-slot>
    </x-backend.card>
@endsection
