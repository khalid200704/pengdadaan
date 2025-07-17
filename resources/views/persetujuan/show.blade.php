@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-8 offset-md-2 bg-light min-vh-100">
            <div class="d-flex justify-content-between align-items-center p-4 border-bottom">
                <div>
                    <h5 class="fw-bold mb-1">Detail Persetujuan</h5>
                    <span class="text-muted">Informasi detail persetujuan permintaan</span>
                </div>
                <a href="{{ route('persetujuan.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-1"></i>Kembali
                </a>
            </div>
            <div class="container-fluid mt-4">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-primary text-white fw-bold">
                                <i class="bi bi-check2-circle me-2"></i>Informasi Persetujuan
                            </div>
                            <div class="card-body">
                                <div class="mb-3"><label class="form-label fw-semibold">Permintaan</label><div>#{{ $persetujuan->permintaan->id ?? '-' }}</div></div>
                                <div class="mb-3"><label class="form-label fw-semibold">Disetujui Oleh</label><div>{{ $persetujuan->disetujuiOleh->nama ?? '-' }}</div></div>
                                <div class="mb-3"><label class="form-label fw-semibold">Tanggal</label><div>{{ $persetujuan->tanggal }}</div></div>
                                <div class="mb-3"><label class="form-label fw-semibold">Status</label><div>{{ ucfirst($persetujuan->status) }}</div></div>
                                <div class="mb-3"><label class="form-label fw-semibold">Keterangan</label><div>{{ $persetujuan->catatan }}</div></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 