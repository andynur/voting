@extends('backend.layouts.app')

@section('title', __('Elections Management'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Kandidat')
        </x-slot>

        @if ($logged_in_user->hasAllAccess())
            <x-slot name="headerActions">
                <x-utils.link
                    icon="c-icon cil-plus"
                    class="card-header-action"
                    :href="route('admin.candidates.create')"
                    :text="__('Tambah Kandidat')"
                />
            </x-slot>
        @endif

        <x-slot name="body">
            <table class="table table-datatable">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($candidates as $candidate)
                        <tr class="middle-row">
                            <td><h3>{{$loop->iteration}}</h3></td>
                            <td>
                                <img class="img-fluid rounded-circle" width="100px" src="{{asset($candidate->profile_image)}}" alt="">
                            </td>
                            <td><h4>{{$candidate->name}}</h4></td>
                            <td>{{$candidate->description}}</td>
                            <td style="width: 150px">
                                <a href="{{route('admin.candidates.edit', $candidate->id)}}" class="btn btn-sm btn-warning text-white">
                                    <i class="cil-pen-alt"></i> Ubah
                                </a>
                                <button data-route="{{route('admin.candidates.destroy', $candidate->id)}}" class="delete-button btn btn-sm btn-danger">
                                    <i class="cil-trash"></i> Hapus
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-slot>
    </x-backend.card>
@endsection

@push('after-styles')
    <style>
        .middle-row td {
            vertical-align: middle;
        }
    </style>
@endpush
