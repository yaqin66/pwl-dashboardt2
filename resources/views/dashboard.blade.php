@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@push('styles')
<!-- ChartJS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css">
@endpush

@section('content')
    <!-- Info boxes -->
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Users</span>
                    <span class="info-box-number">{{ $totalUsers ?? 0 }}</span>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-bullhorn"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Marketing Users</span>
                    <span class="info-box-number">{{ $totalMarketing ?? 0 }}</span>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Transaksi</span>
                    <span class="info-box-number">{{ $totalTransactions ?? 0 }}</span>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-money-bill-wave"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Pemasukan</span>
                    <span class="info-box-number">Rp {{ number_format($totalPemasukan ?? 0, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">
            <!-- Chart Card -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-pie mr-1"></i>
                        Statistik Transaksi Tahun {{ $currentYear ?? date('Y') }}
                    </h3>
                    <div class="card-tools">
                        <ul class="nav nav-pills ml-auto">
                            <li class="nav-item">
                                <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content p-0">
                        <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;">
                            <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
                        </div>
                        <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                            <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Right col -->
        <section class="col-lg-5 connectedSortable">
            <!-- Info Box -->
            <div class="card bg-gradient-info">
                <div class="card-header border-0">
                    <h3 class="card-title">
                        <i class="fas fa-th mr-1"></i>
                        Selamat Datang
                    </h3>
                </div>
                <div class="card-body">
                    <p>Selamat datang di <strong>Dashboard PWL</strong>. Panel ini digunakan untuk mengelola data dan informasi terkait sistem.</p>
                    <p>Gunakan menu di sidebar untuk navigasi ke halaman yang Anda butuhkan.</p>
                </div>
            </div>

            <!-- Recent Activity Card -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-clock mr-1"></i>
                        Transaksi Terbaru
                    </h3>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table m-0">
                            <thead>
                                <tr>
                                    <th>Keterangan</th>
                                    <th>Nominal</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentTransactions ?? [] as $trx)
                                <tr>
                                    <td>{{ $trx->keterangan }}</td>
                                    <td>
                                        @if($trx->jenis == 'masuk')
                                            <span class="text-success">+ Rp {{ number_format($trx->nominal, 0, ',', '.') }}</span>
                                        @else
                                            <span class="text-danger">- Rp {{ number_format($trx->nominal, 0, ',', '.') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($trx->status == 'berhasil')
                                            <span class="badge badge-success">Berhasil</span>
                                        @elseif($trx->status == 'pending')
                                            <span class="badge badge-warning">Pending</span>
                                        @else
                                            <span class="badge badge-danger">Batal</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center">Belum ada transaksi</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer clearfix">
                    <a href="{{ route('transactions.index') }}" class="btn btn-sm btn-secondary float-right">Lihat Semua Transaksi</a>
                </div>
            </div>

            <!-- Calendar Card -->
            <div class="card bg-gradient-success">
                <div class="card-header border-0">
                    <h3 class="card-title">
                        <i class="far fa-calendar-alt mr-1"></i>
                        Kalender
                    </h3>
                </div>
                <div class="card-body pt-0">
                    <div id="calendar" style="width: 100%"></div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
<!-- ChartJS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
<script>
$(function () {
    'use strict';

    // Area Chart
    var areaChartCanvas = document.getElementById('revenue-chart-canvas').getContext('2d');
    var areaChartData = {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
        datasets: [
            {
                label: 'Pemasukan',
                backgroundColor: 'rgba(40, 167, 69, 0.9)',
                borderColor: 'rgba(40, 167, 69, 0.8)',
                pointRadius: 3,
                pointColor: '#28a745',
                pointStrokeColor: 'rgba(40, 167, 69, 1)',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(40, 167, 69, 1)',
                data: {!! json_encode($monthlyPemasukan ?? array_fill(0,12,0)) !!}
            },
            {
                label: 'Pengeluaran',
                backgroundColor: 'rgba(220, 53, 69, 0.9)',
                borderColor: 'rgba(220, 53, 69, 0.8)',
                pointRadius: 3,
                pointColor: '#dc3545',
                pointStrokeColor: 'rgba(220, 53, 69, 1)',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(220, 53, 69, 1)',
                data: {!! json_encode($monthlyPengeluaran ?? array_fill(0,12,0)) !!}
            },
        ]
    };

    var areaChartOptions = {
        maintainAspectRatio: false,
        responsive: true,
        legend: {
            display: true
        },
        scales: {
            xAxes: [{
                gridLines: { display: false }
            }],
            yAxes: [{
                gridLines: { display: false }
            }]
        }
    };

    new Chart(areaChartCanvas, {
        type: 'line',
        data: areaChartData,
        options: areaChartOptions
    });

    // Donut Chart
    var donutChartCanvas = document.getElementById('sales-chart-canvas').getContext('2d');
    
    var totalPemasukanDonut = {!! ($totalPemasukan ?? 0) !!};
    var totalPengeluaranDonut = {!! ($totalPengeluaran ?? 0) !!};
    
    var donutData = {
        labels: ['Pemasukan', 'Pengeluaran'],
        datasets: [{
            data: [totalPemasukanDonut, totalPengeluaranDonut],
            backgroundColor: ['#28a745', '#dc3545'],
        }]
    };
    var donutOptions = {
        maintainAspectRatio: false,
        responsive: true,
    };

    new Chart(donutChartCanvas, {
        type: 'doughnut',
        data: donutData,
        options: donutOptions
    });
});
</script>
@endpush