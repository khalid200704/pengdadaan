@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Main Content -->
        <div class="col-12 col-md-12 bg-light min-vh-100">
            <div class="d-flex justify-content-between align-items-center p-4 border-bottom">
                <div>
                    <h5 class="fw-bold mb-1">Detail Persetujuan</h5>
                    <span class="text-muted">Informasi detail persetujuan permintaan</span>
                </div>
            </div>
            <div class="container-fluid mt-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <p><strong>Permintaan:</strong> #{{ $persetujuan->permintaan->id ?? '-' }}</p>
                                <p><strong>Disetujui Oleh:</strong> {{ $persetujuan->disetujuiOleh->nama ?? '-' }}</p>
                                <p><strong>Tanggal:</strong> {{ $persetujuan->tanggal }}</p>
                                <p><strong>Status:</strong> {{ ucfirst($persetujuan->status) }}</p>
                                <p><strong>Keterangan:</strong> {{ $persetujuan->catatan }}</p>
                            </div>
                        </div>
                        <a href="{{ route('persetujuan.index') }}" class="btn btn-secondary mt-3">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 