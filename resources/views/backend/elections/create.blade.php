@extends('backend.layouts.app')

@section('title', __('Tambah Pemilihan'))


@push('after-styles')
<link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-4-datetime-picker/css/tempusdominus-bootstrap-4.min.css') }}">
@endpush
@section('content')
  <x-backend.card>
      <x-slot name="header">
          @lang('Tambah Pemilihan')
      </x-slot>
      <x-slot name="headerActions">
          <x-utils.link class="card-header-action" :href="route('admin.auth.user.index')" :text="__('Batal')" />
      </x-slot>
      
      <x-slot name="body">
        {{ html()->form('POST', route("admin.elections.store"))->class('form')->open() }}
        @include ("backend.elections.form")
        {{ html()->button($text = "<i class='fas fa-plus-circle'></i> Tambah Pemilihan", $type = 'submit')->class('btn btn-sm btn-primary float-right') }}
        {{ html()->form()->close() }}
      </x-slot>
      
  </x-backend.card>
@endsection

@push('after-scripts')
<script src="{{ asset('assets/vendor/moment/moment.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="{{ asset('assets/vendor/bootstrap-4-datetime-picker/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script>
    $(function() {
        $('.datetimepicker').datetimepicker({
            format: 'DD-MM-YYYY HH:mm:ss',
            icons: {
              time: "cil-clock",
            }
        });
    });
</script>
@endpush
