@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Detail Laporan Pengadaan</h1>
    <div class="card mb-3">
        <div class="card-body">
            <p><strong>Permintaan:</strong> #{{ $laporanPengadaan->permintaan->id ?? '-' }}</p>
            <p><strong>Diterima Oleh:</strong> {{ $laporanPengadaan->diterimaOleh->nama ?? '-' }}</p>
            <p><strong>Tanggal Diterima:</strong> {{ $laporanPengadaan->tanggal_diterima }}</p>
            <p><strong>Status Penerimaan:</strong> {{ ucfirst($laporanPengadaan->status_penerimaan) }}</p>
        </div>
    </div>

    {{-- Status Progress --}}
    @if($laporanPengadaan->permintaan)
    <div class="card mb-3">
        <div class="card-body">
            <h6>Status Progress:</h6>
            <p class="text-muted mb-1">
                @if($laporanPengadaan->permintaan->status_progress === 'dalam_proses')
                    <span class="badge bg-warning">Dalam Proses</span>
                @else
                    <span class="badge bg-success">Selesai</span>
                @endif
            </p>
        </div>
    </div>
    @endif

    {{-- Riwayat Progress Updates --}}
    @if($laporanPengadaan->permintaan && $laporanPengadaan->permintaan->progressUpdates->count() > 0)
    <div class="card mb-3">
        <div class="card-body">
            <h6 class="fw-bold mb-3">Riwayat Progress Updates:</h6>
            <div class="timeline">
                @foreach($laporanPengadaan->permintaan->progressUpdates->sortByDesc('created_at') as $update)
                <div class="card mb-2">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <strong>{{ $update->user->nama }}</strong>
                                <small class="text-muted d-block">{{ $update->created_at->format('d/m/Y H:i') }}</small>
                            </div>
                        </div>
                        <p class="mt-2 mb-1">{{ $update->deskripsi_progress }}</p>
                        @if($update->file_path)
                        <div class="mt-2">
                            <a href="{{ Storage::url($update->file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-file-earmark me-1"></i>{{ $update->file_name }}
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
    <a href="{{ route('laporan-pengadaan.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection 