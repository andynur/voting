@extends('backend.layouts.app')

@section('title', __('Bilik Suara'))

@section('content')
    <x-backend.card>
        <x-slot name="body">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h3>Kotak Suara</h3>
                <button data-route="{{route('admin.booth.destroy-all')}}" class="delete-button btn btn-danger">
                    <i class="cil-trash"></i>
                    Hapus Semua
                </button>
            </div>
            <table class="table table-datatable">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Pemilih</th>
                        <th>Pilihan</th>
                        <th>Waktu Memilih</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($votes as $vote)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$vote->voter->user->name}}</td>
                            <td>{{$vote->candidate->name}}</td>
                            <td>{{$vote->voter->selected_date->format('d-m-Y H:m:s')}}</td>
                            <td>
                                <button data-route="{{route('admin.booth.destroy', $vote->id)}}" class="delete-button btn btn-sm btn-danger">
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
