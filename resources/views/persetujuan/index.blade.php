@extends('layouts.app')
@section('content')
@if(!auth()->user()->canApprove())
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-12 bg-light min-vh-100">
                <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
                    <div class="text-center">
                        <div class="alert alert-danger">
                            <h2 class="fw-bold mb-2">Akses Ditolak</h2>
                            <p class="mb-0">Maaf, Anda tidak memiliki izin untuk mengakses halaman Persetujuan. Hanya Admin dan Kepala Divisi yang dapat menyetujui permintaan.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-12 bg-light min-vh-100">
            <div class="d-flex justify-content-between align-items-center p-4 border-bottom">
                <div>
                    <h5 class="fw-bold mb-1">Daftar Permintaan Menunggu Persetujuan</h5>
                    <span class="text-muted">Permintaan yang memerlukan persetujuan</span>
                </div>
            </div>
            <div class="container-fluid mt-4">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>No. Permintaan</th>
                                <th>Judul</th>
                                <th>Pemohon</th>
                                <th>Divisi</th>
                                <th>Tanggal</th>
                                <th>Total Estimasi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($permintaans as $permintaan)
                            <tr>
                                <td>{{ $permintaan->nomor_permintaan }}</td>
                                <td>{{ $permintaan->judul_permintaan }}</td>
                                <td>{{ $permintaan->user->nama ?? '-' }}</td>
                                <td>{{ $permintaan->user->divisi ?? '-' }}</td>
                                <td><span class="badge bg-secondary">{{ $permintaan->tanggal_permintaan ? $permintaan->tanggal_permintaan->format('d/m/Y') : '-' }}</span></td>
                                <td class="fw-bold text-success">Rp {{ number_format($permintaan->total_estimasi, 0, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('permintaan.show', $permintaan) }}" class="btn btn-sm btn-info" title="Detail"><i class="bi bi-eye"></i></a>
                                    <a href="{{ route('persetujuan.create') }}?permintaan_id={{ $permintaan->id }}" class="btn btn-sm btn-success" title="Setujui/Tolak"><i class="bi bi-check2-circle"></i></a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada permintaan yang menunggu persetujuan</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center">
                    {{ $permintaans->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection 