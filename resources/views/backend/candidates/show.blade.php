@extends('backend.layouts.app')

@section('title', __('Elections Management'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Detail Pemilihan')
        </x-slot>
        <x-slot name="body">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="candidate-tab" data-toggle="tab" href="#candidate" role="tab" aria-controls="candidate" aria-selected="true">Kandidat</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="voter-tab" data-toggle="tab" href="#voter" role="tab" aria-controls="voter" aria-selected="false">Pemilih</a>
            </li>
          </ul>

          {{-- Candidates --}}
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active p-3" id="candidate" role="tabpanel" aria-labelledby="candidate-tab">
              <div class="mb-3">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#candidateAddModal">
                  <i class="cil-plus"></i>
                  Tambah Data
                </button>
                <button class="btn btn-danger">
                  <i class="cil-trash"></i>
                  Hapus Semua Data
                </button>
                <button class="btn btn-warning text-white">
                  <i class="cil-list"></i>
                  Set No. Urut
                </button>
              </div>
              <table class="table table-datatable">
                <thead>
                    <tr>
                        <th>No. Urut</th>
                        <th>Nama Kandidat</th>
                        <th>Foto</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($election->candidates as $candidate)
                        <tr>
                            <td>{{$candidate->number}}</td>
                            <td>{{$candidate->name}}</td>
                            <td>
                              <img src="{{asset($candidate->profile_image)}}" alt="">
                            </td>
                            <td>{!!$candidate->description!!}</td>
                            <td>
                              <button data-route="{{route('admin.elections.destroy', $candidate->id)}}" class="delete-button btn btn-sm btn-danger">
                                <i class="cil-trash"></i>
                            </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
            </div>

            {{-- Voters --}}
            <div class="tab-pane fade p-3" id="voter" role="tabpanel" aria-labelledby="voter-tab">
              <div class="mb-3">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#voterAddModal">
                  <i class="cil-plus"></i>
                  Tambah Data
                </button>
                <button class="btn btn-danger">
                  <i class="cil-trash"></i>
                  Hapus Semua Data
                </button>
              </div>
              <table class="table table-datatable">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Pemilih</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($election->voters as $voter)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$voter->user->name}}</td>
                            <td>{{$voter->user->email}}</td>
                            <td>
                              <span class="badge {{$voter->has_elected === 0 ? 'badge-danger' : 'badge-success'}}">{{$voter->has_elected === 0 ? 'belum memilih' : 'sudah memilih'}}</span>
                            </td>
                            <td>
                                <button data-route="{{route('admin.elections.destroy', $voter->id)}}" class="delete-button btn btn-sm btn-danger">
                                    <i class="cil-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
            {{-- candidate add modal --}}
            <div class="modal fade" id="candidateAddModal" tabindex="-1" role="dialog" aria-labelledby="candidateAddModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  {{ html()->form('POST', route("admin.elections.store"))->class('form')->open() }}
                  <div class="modal-header">
                    <h5 class="modal-title" id="candidateAddModalLabel">Tambah Kandidat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <table class="table table-datatable">
                      <thead>
                          <tr>
                              <th>No.</th>
                              <th>Nama Kandidat</th>
                              <th>Foto</th>
                              <th>Aksi</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($election->availableCandidates() as $candidate)
                              <tr>
                                  <td>{{$loop->iteration}}</td>
                                  <td>{{$candidate->name}}</td>
                                  <td>
                                    <img src="{{asset($candidate->profile_image)}}" alt="">
                                  </td>
                                  <td>
                                    <div class="custom-control custom-checkbox">
                                      <input type="checkbox" class="custom-control-input" id="customCheck1">
                                      <label class="custom-control-label" for="customCheck1"></label>
                                    </div>
                                  </td>
                              </tr>
                          @endforeach
                      </tbody>
                    </table>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    {{ html()->button($text = "<i class='fas fa-plus-circle'></i> Tambah Pemilihan", $type = 'submit')->class('btn btn-sm btn-success float-right') }}
                  </div>
                  {{ html()->form()->close() }}
                  
                </div>
              </div>
            </div>

            {{-- Voter Add Modal --}}
            <div class="modal fade" id="voterAddModal" tabindex="-1" role="dialog" aria-labelledby="voterAddModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  {{ html()->form('POST', route("admin.elections.store"))->class('form')->open() }}
                  <div class="modal-header">
                    <h5 class="modal-title" id="voterAddModalLabel">Tambah Pemilih</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <table class="table table-datatable">
                      <thead>
                          <tr>
                              <th>No.</th>
                              <th>Nama Kandidat</th>
                              <th>Foto</th>
                              <th>Aksi</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($election->availableVoters() as $voter)
                              <tr>
                                  <td>{{$loop->iteration}}</td>
                                  <td>{{$voter->name}}</td>
                                  <td>{{$voter->email}}</td>
                                  <td>
                                    <div class="custom-control custom-checkbox">
                                      <input type="checkbox" name="voters[]" class="custom-control-input" id="voter-check-{{$voter->id}}">
                                      <label class="custom-control-label" for="voter-check-{{$voter->id}}"></label>
                                    </div>
                                  </td>
                              </tr>
                          @endforeach
                      </tbody>
                    </table>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    {{ html()->button($text = "<i class='fas fa-plus-circle'></i> Tambah Pemilihan", $type = 'submit')->class('btn btn-sm btn-success float-right') }}
                  </div>
                  {{ html()->form()->close() }}
                  
                </div>
              </div>
            </div>
          </div>
        </x-slot>
    </x-backend.card>
@endsection
