@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-10 offset-md-1 bg-light min-vh-100">
            <div class="d-flex justify-content-between align-items-center p-4 border-bottom">
                <div>
                    <h5 class="fw-bold mb-1">Detail Budget</h5>
                    <span class="text-muted">Informasi detail budget dan status penggunaan</span>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('budgets.edit', $budget) }}" class="btn btn-warning">
                        <i class="bi bi-pencil-square me-1"></i>Edit
                    </a>
                    <a href="{{ route('budgets.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-1"></i>Kembali
                    </a>
                </div>
            </div>
            <div class="container-fluid mt-4">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-primary text-white fw-bold">
                                <i class="bi bi-wallet2 me-2"></i>Informasi Budget
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Nama Budget</label>
                                    <div>{{ $budget->nama_budget }}</div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Tahun</label>
                                    <div>{{ $budget->tahun }}</div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Total Budget</label>
                                    <div class="fs-5 fw-bold text-success">Rp {{ number_format($budget->total_budget, 0, ',', '.') }}</div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Keterangan</label>
                                    <div>{{ $budget->keterangan ?? 'Tidak ada keterangan' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-info text-white fw-bold">
                                <i class="bi bi-bar-chart me-2"></i>Status Penggunaan
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Terpakai</label>
                                    <div class="fs-5 fw-bold text-danger">Rp {{ number_format($budget->terpakai, 0, ',', '.') }}</div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Tersisa</label>
                                    <div class="fs-5 fw-bold text-success">Rp {{ number_format($budget->tersisa, 0, ',', '.') }}</div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Persentase Terpakai</label>
                                    <div class="progress" style="height: 20px;">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $budget->persentase_terpakai }}%;" aria-valuenow="{{ $budget->persentase_terpakai }}" aria-valuemin="0" aria-valuemax="100">{{ $budget->persentase_terpakai }}%</div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Tanggal Dibuat</label>
                                    <div>{{ $budget->created_at->format('d/m/Y H:i') }}</div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Terakhir Diupdate</label>
                                    <div>{{ $budget->updated_at->format('d/m/Y H:i') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 