@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Main Content -->
        <div class="col-12 col-md-12 bg-light min-vh-100">
            <div class="d-flex justify-content-between align-items-center p-4 border-bottom">
                <div>
                    <h5 class="fw-bold mb-1">Dashboard Pengadaan Internal</h5>
                    <span class="text-muted">Selamat datang, {{ Auth::user()->nama ?? '' }} ({{ Auth::user()->divisi ?? '' }})</span>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <span class="text-muted">{{ date('d F Y') }}</span>
                    <img src="{{ asset('logo.png') }}" alt="Logo" style="width:40px; height:40px; object-fit:cover; border-radius:50%; display:inline-block;">
                </div>
            </div>

            <div class="container-fluid mt-4">
                <!-- Quick Actions -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <h6 class="fw-bold mb-3">Aksi Cepat</h6>
                                <div class="d-flex gap-2 flex-wrap">
                                    <a href="{{ route('permintaan.create') }}" class="btn btn-primary">
                                        <i class="bi bi-plus-circle me-2"></i>Buat Permintaan Baru
                                    </a>
                                    @if(auth()->user()->canManageBudget())
                                    <a href="{{ route('persetujuan.index') }}" class="btn btn-warning">
                                        <i class="bi bi-check-circle me-2"></i>Persetujuan Pending
                                    </a>
                                    <a href="{{ route('budgets.index') }}" class="btn btn-info">
                                        <i class="bi bi-cash-stack me-2"></i>Kelola Budget
                                    </a>
                                    @endif
                                    <a href="{{ route('laporan-pengadaan.index') }}" class="btn btn-success">
                                        <i class="bi bi-file-earmark-text me-2"></i>Laporan Pengadaan
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Statistics Cards -->
                <div class="row g-4 mb-4">
                    <!-- Total Permintaan -->
                    <div class="col-md-3">
                        <div class="card text-white" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <div class="fs-6">Total Permintaan</div>
                                        <div class="fs-2 fw-bold">{{ $statistikPermintaan['total'] ?? 0 }}</div>
                                        <div class="fs-6 mt-2">Tahun {{ date('Y') }}</div>
                                    </div>
                                    <div class="fs-1">
                                        <i class="bi bi-file-earmark-text"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Permintaan Disetujui -->
                    <div class="col-md-3">
                        <div class="card text-white" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <div class="fs-6">Disetujui</div>
                                        <div class="fs-2 fw-bold">{{ $statistikPermintaan['disetujui'] ?? 0 }}</div>
                                        <div class="fs-6 mt-2">Rp {{ number_format($totalNilaiDisetujui ?? 0, 0, ',', '.') }}</div>
                                    </div>
                                    <div class="fs-1">
                                        <i class="bi bi-check-circle"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Permintaan Pending -->
                    <div class="col-md-3">
                        <div class="card text-white" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <div class="fs-6">Menunggu Approval</div>
                                        <div class="fs-2 fw-bold">{{ $statistikPermintaan['menunggu'] ?? 0 }}</div>
                                        <div class="fs-6 mt-2">Perlu ditindak</div>
                                    </div>
                                    <div class="fs-1">
                                        <i class="bi bi-clock"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Dana Tersisa -->
                    <div class="col-md-3">
                        <div class="card text-dark bg-light border-0 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <div class="fs-6">Dana Tersisa</div>
                                        <div class="fs-4 fw-bold">Rp {{ number_format($saldoPendanaan['total'], 0, ',', '.') }}</div>
                                        <div class="fs-6 mt-2">Dari total Rp {{ number_format($totalBudget ?? 0, 0, ',', '.') }}</div>
                                    </div>
                                    <div class="fs-1 text-success">
                                        <i class="bi bi-wallet2"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts Row -->
                <div class="row g-4">
                    <!-- Aktivitas Mingguan -->
                    <div class="col-md-8">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-white fw-bold">
                                <i class="bi bi-graph-up me-2"></i>Aktivitas Permintaan Minggu Ini
                            </div>
                            <div class="card-body">
                                <canvas id="aktivitasMingguanChart" height="120"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Statistik Status -->
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-white fw-bold">
                                <i class="bi bi-pie-chart me-2"></i>Status Permintaan
                            </div>
                            <div class="card-body">
                                <canvas id="statusChart" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity & Budget Usage -->
                <div class="row g-4 mt-4">
                    <!-- Permintaan Terbaru -->
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-white fw-bold">
                                <i class="bi bi-clock-history me-2"></i>Permintaan Terbaru
                            </div>
                            <div class="card-body p-0">
                                @if(isset($permintaanTerbaru) && $permintaanTerbaru->count() > 0)
                                    <div class="list-group list-group-flush">
                                        @foreach($permintaanTerbaru as $permintaan)
                                        <div class="list-group-item border-0">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <div class="fw-semibold">{{ $permintaan->judul_permintaan }}</div>
                                                    <div class="text-muted small">{{ $permintaan->user->nama ?? '-' }} • {{ $permintaan->tanggal_permintaan ? $permintaan->tanggal_permintaan->format('d/m/Y') : '-' }}</div>
                                                </div>
                                                <div class="text-end">
                                                    <div class="fw-bold text-success">Rp {{ number_format($permintaan->total_estimasi, 0, ',', '.') }}</div>
                                                    <div>
                                                        @switch($permintaan->status)
                                                            @case('menunggu_persetujuan')
                                                                <span class="badge bg-warning">Pending</span>
                                                                @break
                                                            @case('disetujui')
                                                                <span class="badge bg-success">Disetujui</span>
                                                                @break
                                                            @case('ditolak')
                                                                <span class="badge bg-danger">Ditolak</span>
                                                                @break
                                                            @default
                                                                <span class="badge bg-secondary">{{ $permintaan->status }}</span>
                                                        @endswitch
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-center py-4">
                                        <i class="bi bi-inbox display-4 text-muted"></i>
                                        <p class="text-muted mt-2">Belum ada permintaan</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Budget Usage -->
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-white fw-bold">
                                <i class="bi bi-cash-stack me-2"></i>Penggunaan Budget
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between mb-1">
                                        <span>Total Budget</span>
                                        <span class="fw-bold">Rp {{ number_format($totalBudget ?? 0, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="progress" style="height: 8px;">
                                        <div class="progress-bar bg-success" style="width: {{ $totalBudget > 0 ? ($totalTerpakai / $totalBudget) * 100 : 0 }}%"></div>
                                    </div>
                                </div>

                                <div class="row text-center">
                                    <div class="col-6">
                                        <div class="border-end">
                                            <div class="fw-bold text-success">Rp {{ number_format($totalTerpakai ?? 0, 0, ',', '.') }}</div>
                                            <div class="text-muted small">Terpakai</div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="fw-bold text-info">Rp {{ number_format($saldoPendanaan['total'], 0, ',', '.') }}</div>
                                        <div class="text-muted small">Tersisa</div>
                                    </div>
                                </div>

                                @if(isset($totalBudget) && $totalBudget > 0 && ($totalTerpakai / $totalBudget) > 0.8)
                                <div class="alert alert-warning mt-3 mb-0">
                                    <i class="bi bi-exclamation-triangle me-2"></i>
                                    Budget hampir habis! {{ number_format(($totalTerpakai / $totalBudget) * 100, 1) }}% telah digunakan.
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js CDN & Bootstrap Icons CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Aktivitas Mingguan Line Chart
    const aktivitasMingguan = @json($aktivitasMingguan ?? ['labels' => [], 'data' => []]);
    new Chart(document.getElementById('aktivitasMingguanChart'), {
        type: 'line',
        data: {
            labels: aktivitasMingguan.labels,
            datasets: [{
                label: 'Jumlah Permintaan',
                data: aktivitasMingguan.data,
                borderColor: '#667eea',
                backgroundColor: 'rgba(102, 126, 234, 0.1)',
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#667eea',
                pointBorderColor: '#fff',
                pointBorderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });

    // Status Permintaan Pie Chart
    const statusData = @json($permintaanData ?? ['labels' => [], 'data' => []]);
    new Chart(document.getElementById('statusChart'), {
        type: 'doughnut',
        data: {
            labels: statusData.labels,
            datasets: [{
                data: statusData.data,
                backgroundColor: ['#f093fb', '#11998e', '#f5576c'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        usePointStyle: true
                    }
                }
            }
        }
    });
</script>
@endsection
