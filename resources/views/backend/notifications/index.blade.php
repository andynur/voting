@extends('backend.layouts.app')

@section('title', __('Notification Management'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Pesan Notifikasi')
        </x-slot>

        <x-slot name="headerActions">
            <x-utils.link
                icon="c-icon cil-send"
                class="card-header-action"
                :href="route('admin.notification.send_all')"
                :text="__('Kirim Broadcast WA')"
            />
        </x-slot>

        <x-slot name="body">
            <table class="table table-datatable w-100">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>PIN</th>
                        <th>Nomor WA</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($members as $member)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $member->name }}</td>
                            <td>{{ $member->pin }}</td>
                            <td>{{ $member->wa }}</td>
                            <td style="width: 150px">
                                <a href="{{ route('admin.notification.send', $member->id) }}" class="btn btn-sm btn-info text-white">
                                    <i class="cil-send"></i> Kirim Ulang
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-slot>
    </x-backend.card>
@endsection
