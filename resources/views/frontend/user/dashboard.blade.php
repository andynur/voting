@extends('frontend.layouts.core')

@section('title', __('Vote'))

@section('content')
    <div class="container pb-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1 class="text-center mb-4">Daftar Kandidat</h1>
                @if ($election->has_elected !== 0)
                    <div class="alert alert-success" role="alert">
                        <i class="fas fa-check-circle mr-2"></i>
                        <b>Anda Sudah Memilih!</b> Terima kasih karena telah menggunakan suara anda dengan bijak
                    </div>

                    <a href="{{route('frontend.live-polling')}}" class="btn btn-info w-100 btn-lg mb-3">
                        <i class="fas fa-balance-scale mr-2"></i> Lihat Live Polling
                    </a>
                @endif

                <form action="#">
                    <div class="row">
                        @foreach ($election->election->candidates as $candidate)
                        <div class="col-md-4 col-lg-4 col-sm-12">
                            <div class="card {{$election->has_elected == 1 ? 'has-elected' : ''}} {{$election->vote()->candidate_id == $candidate->id && $election->has_elected == 1 ? 'elected' : 'not-elected'}}">
                                <img class="card-img-top" src="{{asset($candidate->profile_image)}}" alt="Card image cap">
                                <div class="card-body text-center">
                                    <h5 class="card-title">{{$candidate->name}}</h5>
                                    @if ($election->has_elected == 0)
                                        <div class="radio-container mt-4">
                                            <input type="radio" id="candididate-{{$candidate->id}}" name="candidate" value="{{$candidate->id}}">
                                            <label for="candididate-{{$candidate->id}}" class="w-100">
                                                <i class="fas fa-check mr-2"></i>
                                                Pilih
                                            </label>
                                        </div>
                                    @else
                                        @if ($election->vote()->candidate_id == $candidate->id && $election->has_elected == 1)
                                            <i class="fas fa-check-circle fa-5x"></i>
                                        @else
                                            <i class="fas fa-times-circle fa-5x"></i>
                                        @endif
                                    @endif

                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </form>
                @if ($election->has_elected === 0)
                    <button class="btn btn-success w-100 mt-4 btn-lg" id="submit-button">
                        Kirim
                    </button>
                @endif
            </div>
        </div>
    </div>
@endsection
@push('after-styles')
    <style>
        .radio-container {
            margin: 10px;
        }
        .radio-container input[type="radio"] {
            opacity: 0;
            position: fixed;
            width: 0;
        }
        .radio-container label {
            display: inline-block;
            padding: 5px 20px;
            font-family: sans-serif, Arial;
            font-size: 16px;
            border: 2px solid #444;
            border-radius: 4px;
            cursor: pointer;
        }

        .radio-container label:hover {
            background-color: #dfd;
        }
        .radio-container input[type="radio"]:checked + label {
            background-color: #bfb;
            border-color: #4c4;
        }
        .card.has-elected.elected {
            background-color: #4c4;
            color: #fff!important;
        }
        .card.has-elected.not-elected {
            background-color: #E3342F;
            color: #fff!important;
        }
    </style>
@endpush
@push('after-scripts')
    <script>
        $(function() {
            $(document).on('click', '#submit-button', function (e) {
                if($('input[name=candidate]:checked').val()) {
                    Swal.fire({
                        title: 'Apa anda yakin?',
                        text: "Pilihan anda tidak akan bisa dikembalikan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        reverseButtons: true,
                        confirmButtonText: 'Ya, Saya yakin',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: `/voted/${$('input[name=candidate]:checked').val()}`,
                                type: 'POST',
                                dataType: "JSON",
                                data: {
                                    "_method": 'POST',
                                    "_token": $('meta[name="csrf-token"]').attr('content'),
                                },
                                success: function (val) {
                                    location.reload();
                                },
                                error: function (xhr, ajaxOptions, thrownError) {
                                    Swal.fire(
                                        'Gagal!',
                                        xhr.responseJSON.message || "Data Gagal Dihapus",
                                        'error'
                                    )
                                    console.log(xhr.responseText, ajaxOptions, thrownError)
                                }
                            })
                        }
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal memilih!',
                        text: 'Pastikan anda telah memilih salah satu kandidat!'
                    })
                }
            })
        })
    </script>
@endpush

