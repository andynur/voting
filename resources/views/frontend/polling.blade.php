@extends('frontend.layouts.core')

@section('title', __('Dashboard'))

@section('content')
    <div class="container pb-4">
      <div class="row">
        <div class="col-sm-6 col-lg-6 col-12">
            <div class="card mb-4 text-white bg-success">
                <div class="card-body pb-2 d-flex justify-content-between align-items-start">
                    <div>
                        <h5>Total Suara Masuk</h5>
                        <h1>{{$election->hasVoted()}} Suara</h1>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col-->
        <div class="col-sm-6 col-lg-6 col-12">
            <div class="card mb-4 text-white bg-danger">
                <div class="card-body pb-2 d-flex justify-content-between align-items-start">
                    <div>
                        <h5>Total Suara Belum Masuk</h5>
                        <h1>{{$election->yetVoted()}} Suara</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 mb-4">
            <div class="row candidate-container">
                @foreach ($election->candidates as $candidate)
                <div class="col-md-4 col-lg-4 col-sm-12">
                    <div class="card align-items-center pt-0">
                        <img class="card-img-top" src="{{asset($candidate->profile_image)}}" alt="Card image cap">
                        <div class="card-body text-center p-2">

                        </div>
                        <div class="w-100 text-center py-3" style="background: {{$colors[$loop->iteration - 1]}}">
                            <h5 class="card-title text-white m-0">#{{$loop->iteration}} {{$candidate->name}}</h5>
                            <h1 class="text-white mt-2">{{ $candidate->votes() }} Suara</h1>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-12 text-left">
            <a href="{{route('frontend.live-polling')}}" id="refresh-btn" class="btn btn-info btn-lg">
                <i class="fas fa-sync mr-2"></i>
                Refresh Data
            </a>
        </div>
        <div class="col-12 mt-4">
            <div id="bar-chart"></div>
        </div>
        <div class="col-12 mt-4">
            <x-backend.card>
            <x-slot name="header">
                @lang('Daftar Peserta')
            </x-slot>
            <x-slot name="body">
                <table class="table table-datatable datatable">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Pemilih</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($votes as $vote)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$vote->voter->user->name}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </x-slot>
            </x-backend.card>
        </div>
      </div>
    </div>
@endsection
@push('after-styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.25/datatables.min.css"/>
    <style>
        .candidate-container .card {
            background: #f7f7f7;
        }
        .candidate-container .card .card-img-top {
            width: 14rem;
            padding-top: 1rem;
        }
        @media (max-width: 768px) {
            .candidate-container .card .card-img-top {
                width: 10rem;
                padding-top: 1rem;
            }

            #refresh-btn {
                width: 100%;
            }
        }
    </style>
@endpush
@push('after-scripts')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.25/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-3d.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script>
        $('.datatable').DataTable();
        const results = JSON.parse('{!! json_encode($results); !!}');
        Highcharts.chart('bar-chart', {
            chart: {
                type: 'column'
            },
            plotOptions: {
                series: {
                    colorByPoint: true,
                    colors: ['#FEC007', '#4CBC74', '#62C2DF', '#86D6A', '#21A8D9']
                }
            },
            title: {
                text: ''
            },
            xAxis: {
                categories: results.map(result => result[0]),
                title: {
                    text: null
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Pemilih',
                    align: 'high'
                },
                labels: {
                    overflow: 'justify'
                }
            },
            tooltip: {
                valueSuffix: ' Orang'
            },
            credits: {
                enabled: false
            },
            series: [{
                name: 'Jumlah Suara',
                data: results.slice(0, -1)
            }]
        });
    </script>
@endpush

