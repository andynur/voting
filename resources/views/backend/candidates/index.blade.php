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
                        <th>Nama</th>
                        <th>Foto</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
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
                            <td>{{$candidate->description}}</td>
                            <td style="width: 150px">
                                <a href="{{route('admin.candidates.edit', $candidate->id)}}" class="btn btn-sm btn-warning text-white">
                                    <i class="cil-pen-alt"></i>
                                </a>
                                <button data-route="{{route('admin.candidates.destroy', $candidate->id)}}" class="delete-button btn btn-sm btn-danger">
                                    <i class="cil-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-slot>
    </x-backend.card>
@endsection
