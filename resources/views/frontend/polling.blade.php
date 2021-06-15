@extends('frontend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <div class="container py-4">
      <div class="row">
        <div class="col-sm-6 col-lg-6 col-12">
            <div class="card mb-4 text-white bg-success">
                <div class="card-body pb-2 d-flex justify-content-between align-items-start">
                    <div>
                        <h5>Total Suara Masuk</h5>
                        <h1>{{$election->hasVoted()}}</h1>
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
                        <h1>{{$election->yetVoted()}}</h1>
                    </div>
                </div>
            </div>
        </div>
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
              <table class="table table-datatable">
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
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-3d.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script>
        const results = JSON.parse('{!! json_encode($results); !!}');
        Highcharts.chart('bar-chart', {
            chart: {
                type: 'column'
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

