@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <div class="row">
        <div class="col-sm-6 col-lg-3">
            <div class="card mb-4 text-white bg-gradient-warning">
                <div class="card-body pb-2 d-flex justify-content-between align-items-start">
                    <div>
                        <h1>{{$election->candidates->count()}}</h1>
                        <h5>Kandidat</h5>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col-->
        <div class="col-sm-6 col-lg-3">
            <div class="card mb-4 text-white bg-gradient-primary">
                <div class="card-body pb-2 d-flex justify-content-between align-items-start">
                    <div>
                        <h1>{{$election->voters->count()}}</h1>
                        <h5>Total Suara</h5>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col-->
        <div class="col-sm-6 col-lg-3">
            <div class="card mb-4 text-white bg-gradient-success">
                <div class="card-body pb-2 d-flex justify-content-between align-items-start">
                    <div>
                        <h1>{{$election->hasVoted()}}</h1>
                        <h5>Total Sudah Memilih</h5>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col-->
        <div class="col-sm-6 col-lg-3">
            <div class="card mb-4 text-white bg-gradient-danger">
                <div class="card-body pb-2 d-flex justify-content-between align-items-start">
                    <div>
                        <h1>{{$election->yetVoted()}}</h1>
                        <h5>Total Belum Memilih</h5>
                    </div>
                </div>
            </div>
        </div>
    <!-- /.col-->
    </div>
    <div class="row">
        <div class="col-12">
            <x-backend.card>
                <x-slot name="header">
                    Perbandingan Perolehan Suara
                </x-slot>
                <x-slot name="body">
                    <div class="body flex-grow-1 px-3">
                        <div class="container-lg">
                            <div id="bar-chart"></div>
                        </div>
                    </div>
                </x-slot>
            </x-backend.card>
        </div>
        <div class="col-12">
            <x-backend.card>
                <x-slot name="header">
                    Persentase Perolehan Suara
                </x-slot>
                <x-slot name="body">
                    <div class="body flex-grow-1 px-3">
                        <div class="container-lg">
                            <div id="pie-chart"></div>
                        </div>
                    </div>
                </x-slot>
            </x-backend.card>
        </div>
    </div>
@endsection
@push('after-scripts')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-3d.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script>
        const results = JSON.parse('{!! json_encode($results); !!}');
        Highcharts.chart('pie-chart', {
            chart: {
                type: 'pie',
                options3d: {
                    enabled: true,
                    alpha: 45,
                    beta: 0
                }
            },
            title: {
                text: ''
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    depth: 35,
                    dataLabels: {
                        enabled: true,
                        format: '{point.name}'
                    }
                },
                series: {
                    colorByPoint: true,
                    colors: ['#FEC007', '#4CBC74', '#62C2DF', '#21A8D9', '#21A8D9']
                }
            },
            series: [{
                type: 'pie',
                name: 'Jumlah Suara',
                data: results
            }]
        });

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
            plotOptions: {
                series: {
                    colorByPoint: true,
                    colors: ['#FEC007', '#4CBC74', '#62C2DF', '#86D6A', '#21A8D9']
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
