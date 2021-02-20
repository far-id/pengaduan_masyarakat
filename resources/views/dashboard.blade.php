@extends('layouts.app')

@section('chart')
    <canvas id="bigDashboardChart"  class="bigDashboardChart2"></canvas>

    <script src="{{ asset('assets/js/plugins/chartjs.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            chart.initDashboardPageCharts();
        });
    </script>
    <script>
        chart = {
            
            initDashboardPageCharts: function() {
        
                chartColor = "#FFFFFF";
                chartColor2 = "#B1DDF0";
        
                // General configuration for the charts with Line gradientStroke
                gradientChartOptionsConfiguration = {
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    },
                    tooltips: {
                        bodySpacing: 4,
                        mode: "nearest",
                        intersect: 0,
                        position: "nearest",
                        xPadding: 10,
                        yPadding: 10,
                        caretPadding: 10
                    },
                    responsive: 1,
                    scales: {
                        yAxes: [{
                        display: 0,
                        gridLines: 0,
                        ticks: {
                            display: false
                        },
                        gridLines: {
                            zeroLineColor: "transparent",
                            drawTicks: false,
                            display: false,
                            drawBorder: false
                        }
                        }],
                        xAxes: [{
                        display: 0,
                        gridLines: 0,
                        ticks: {
                            display: false
                        },
                        gridLines: {
                            zeroLineColor: "transparent",
                            drawTicks: false,
                            display: false,
                            drawBorder: false
                        }
                        }]
                    },
                    layout: {
                        padding: {
                        left: 0,
                        right: 0,
                        top: 15,
                        bottom: 15
                        }
                    }
                };
        
                gradientChartOptionsConfigurationWithNumbersAndGrid = {
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    },
                    tooltips: {
                        bodySpacing: 4,
                        mode: "nearest",
                        intersect: 0,
                        position: "nearest",
                        xPadding: 10,
                        yPadding: 10,
                        caretPadding: 10
                    },
                    responsive: true,
                    scales: {
                        yAxes: [{
                        gridLines: 0,
                        gridLines: {
                            zeroLineColor: "transparent",
                            drawBorder: false
                        }
                        }],
                        xAxes: [{
                        display: 0,
                        gridLines: 0,
                        ticks: {
                            display: false
                        },
                        gridLines: {
                            zeroLineColor: "transparent",
                            drawTicks: false,
                            display: false,
                            drawBorder: false
                        }
                        }]
                    },
                    layout: {
                        padding: {
                        left: 0,
                        right: 0,
                        top: 15,
                        bottom: 15
                        }
                    }
                };
        
                var ctx = document.getElementById('bigDashboardChart').getContext("2d");
        
                var gradientStroke = ctx.createLinearGradient(500, 0, 100, 0);
                gradientStroke.addColorStop(0, '#80b6f4');
                gradientStroke.addColorStop(1, chartColor);
        
                var gradientFill = ctx.createLinearGradient(0, 200, 0, 50);
                gradientFill.addColorStop(0, "rgba(128, 182, 244, 0)");
                gradientFill.addColorStop(1, "rgba(255, 255, 255, 0.24)");
        
                var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"],
                    datasets: [{
                        label: "Pengaduan",
                        borderColor: chartColor,
                        pointBorderColor: chartColor,
                        pointBackgroundColor: "#1e3d60",
                        pointHoverBackgroundColor: "#1e3d60",
                        pointHoverBorderColor: chartColor,
                        pointBorderWidth: 1,
                        pointHoverRadius: 7,
                        pointHoverBorderWidth: 2,
                        pointRadius: 5,
                        fill: true,
                        backgroundColor: gradientFill,
                        borderWidth: 4,
                        data: {!! json_encode($pengaduan) !!},
                    },
                    {
                        label: "Aspirasi",
                        borderColor: chartColor2,
                        pointBorderColor: chartColor2,
                        pointBackgroundColor: "#3B350F",
                        pointHoverBackgroundColor: "#3B350F",
                        pointHoverBorderColor: chartColor,
                        pointBorderWidth: 1,
                        pointHoverRadius: 7,
                        pointHoverBorderWidth: 2,
                        pointRadius: 5,
                        fill: true,
                        backgroundColor: gradientFill,
                        borderWidth: 4,
                        data: {!! json_encode($aspirasi) !!} ,
                    }],
                },
                options: {
                    layout: {
                    padding: {
                        left: 20,
                        right: 20,
                        top: 0,
                        bottom: 0
                    }
                    },
                    maintainAspectRatio: false,
                    tooltips: {
                        backgroundColor: '#fff',
                        titleFontColor: '#333',
                        bodyFontColor: '#666',
                        bodySpacing: 4,
                        xPadding: 12,
                        mode: "nearest",
                        intersect: 0,
                        position: "nearest"
                    },
                    legend: {
                        position: "bottom",
                        fillStyle: "#FFF",
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                fontColor: "rgba(255,255,255,0.4)",
                                fontStyle: "bold",
                                beginAtZero: true,
                                maxTicksLimit: 5,
                                padding: 10
                            },
                            gridLines: {
                                drawTicks: true,
                                drawBorder: false,
                                display: true,
                                color: "rgba(255,255,255,0.1)",
                                zeroLineColor: "transparent"
                            }
        
                        }],
                        xAxes: [{
                            gridLines: {
                                zeroLineColor: "transparent",
                                display: false,
        
                            },
                            ticks: {
                                padding: 10,
                                fontColor: "rgba(255,255,255,0.4)",
                                fontStyle: "bold"
                            }
                        }]
                    }
                }
                });
            },
        };
    </script>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="title">Kegiatan Desa</h5>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-md-3">
        @forelse ($kegiatan as $k)
        @php
            $gambar = json_decode($k->gambar);
        @endphp
            <div class="col mb-4">
                <div class="card h-100">
                    <a type="button" data-toggle="modal" data-target="#kegiatan{{ $loop->iteration }}">
                        @foreach ((array) $gambar as $g)
                        <div style="height: 200px;">
                            <img src="{{ asset('img/kegiatan/' . $g) }}" class="card-img-top mh-100" alt="">
                        </div>
                        @endforeach
                    </a>
                    <div class="card-header">
                        <h5 class="card-tittle mb-0">{{ $k->nama }}</h5>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title mt-0">{{ $k->judul }}</h4>
                        <p class="card-text">{{ $k->kegiatan }}</p>
                        <p class="card-text"><small class="text-muted">{{ $k->created_at->diffForHumans() }}</small></p>
                    </div>
                </div>
            </div>


        @empty
            
        @endforelse
    </div>
    @forelse ($kegiatan as $k)
    @php
        $gambar = json_decode($k->gambar);
    @endphp
    <div class="modal fade" id="kegiatan{{ $loop->iteration }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @foreach ((array) $gambar as $g)
                        <img src="{{ asset('img/kegiatan/' . $g) }}" class="card-img-top mh-100" alt="">
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @empty
        
    @endforelse


@endsection
