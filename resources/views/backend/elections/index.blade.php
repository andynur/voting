@extends('backend.layouts.app')

@section('title', __('Elections Management'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Pemilihan')
        </x-slot>

        @if ($logged_in_user->hasAllAccess())
            <x-slot name="headerActions">
                <x-utils.link
                    icon="c-icon cil-plus"
                    class="card-header-action"
                    :href="route('admin.elections.create')"
                    :text="__('Tambah Pemilihan')"
                />
            </x-slot>
        @endif

        <x-slot name="body">
            <table class="table table-datatable">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Total Pemilih</th>
                        <th>Total Sudah Memilih</th>
                        <th>Total Belum Memilih</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($elections as $election)
                        <tr>
                            <td>{{$election->name}}</td>
                            <td>{{$election->start_date->format('Y-m-d H:m:s')}} - {{$election->end_date->format('Y-m-d H:m:s')}}</td>
                            <td>{{$election->voters->count()}}</td>
                            <td>{{$election->hasVoted()}}</td>
                            <td>{{$election->yetVoted()}}</td>
                            <td style="width: 150px">
                                <a href="{{route('admin.elections.show', $election->id)}}" class="btn btn-sm btn-primary">
                                    <i class="cil-list"></i>
                                </a>
                                <a href="{{route('admin.elections.edit', $election->id)}}" class="btn btn-sm btn-warning text-white">
                                    <i class="cil-pen-alt"></i>
                                </a>
                                <button data-route="{{route('admin.elections.destroy', $election->id)}}" class="delete-button btn btn-sm btn-danger">
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
