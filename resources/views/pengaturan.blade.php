@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-12 bg-light min-vh-100">
            <div class="d-flex justify-content-between align-items-center p-4 border-bottom">
                <div>
                    <h5 class="fw-bold mb-1" style="font-family: 'Segoe UI', 'Roboto', 'Arial', sans-serif; color: #222;">Pengaturan</h5>
                    <span class="text-muted" style="font-family: 'Segoe UI', 'Roboto', 'Arial', sans-serif;">Konfigurasi sistem pengadaan internal</span>
                </div>
            </div>
            
            <div class="container-fluid mt-4">
                <div class="row">
                    <!-- Profil Pengguna -->
                    <div class="col-md-6 mb-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header bg-primary text-white">
                                <h6 class="mb-0"><i class="bi bi-person-circle me-2"></i>Profil Pengguna</h6>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <strong>Nama:</strong>
                                    </div>
                                    <div class="col-sm-8">
                                        {{ auth()->user()->nama }}
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <strong>Email:</strong>
                                    </div>
                                    <div class="col-sm-8">
                                        {{ auth()->user()->email }}
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <strong>Divisi:</strong>
                                    </div>
                                    <div class="col-sm-8">
                                        {{ auth()->user()->divisi }}
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <strong>Jabatan:</strong>
                                    </div>
                                    <div class="col-sm-8">
                                        {{ auth()->user()->jabatan }}
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <strong>Role:</strong>
                                    </div>
                                    <div class="col-sm-8">
                                        <span class="badge bg-{{ auth()->user()->role === 'admin' ? 'danger' : (auth()->user()->role === 'division_head' ? 'warning' : 'info') }}">
                                            {{ ucfirst(str_replace('_', ' ', auth()->user()->role)) }}
                                        </span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Statistik Pengguna -->
                    <div class="col-md-6 mb-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header bg-success text-white">
                                <h6 class="mb-0"><i class="bi bi-graph-up me-2"></i>Statistik Pengguna</h6>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-sm-8">
                                        <strong>Total Permintaan Dibuat:</strong>
                                    </div>
                                    <div class="col-sm-4 text-end">
                                        <span class="badge bg-primary">{{ auth()->user()->permintaan()->count() }}</span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-8">
                                        <strong>Permintaan Disetujui:</strong>
                                    </div>
                                    <div class="col-sm-4 text-end">
                                        <span class="badge bg-success">{{ auth()->user()->permintaan()->where('status', 'disetujui')->count() }}</span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-8">
                                        <strong>Permintaan Ditolak:</strong>
                                    </div>
                                    <div class="col-sm-4 text-end">
                                        <span class="badge bg-danger">{{ auth()->user()->permintaan()->where('status', 'ditolak')->count() }}</span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-8">
                                        <strong>Menunggu Persetujuan:</strong>
                                    </div>
                                    <div class="col-sm-4 text-end">
                                        <span class="badge bg-warning">{{ auth()->user()->permintaan()->where('status', 'menunggu_persetujuan')->count() }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pengaturan Sistem -->
                    @if(auth()->user()->canManageBudget())
                    <div class="col-md-6 mb-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header bg-info text-white">
                                <h6 class="mb-0"><i class="bi bi-gear me-2"></i>Pengaturan Sistem</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Tahun Anggaran Aktif:</label>
                                    <select class="form-select" id="tahunAnggaran">
                                        <option value="2024" {{ date('Y') == 2024 ? 'selected' : '' }}>2024</option>
                                        <option value="2025" {{ date('Y') == 2025 ? 'selected' : '' }}>2025</option>
                                        <option value="2026" {{ date('Y') == 2026 ? 'selected' : '' }}>2026</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Limit Permintaan per Bulan:</label>
                                    <input type="number" class="form-control" value="10" min="1" max="50">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Notifikasi Email:</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="notifPermintaan" checked>
                                        <label class="form-check-label" for="notifPermintaan">
                                            Permintaan baru
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="notifPersetujuan" checked>
                                        <label class="form-check-label" for="notifPersetujuan">
                                            Status persetujuan
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="notifBudget" checked>
                                        <label class="form-check-label" for="notifBudget">
                                            Peringatan budget
                                        </label>
                                    </div>
                                </div>
                                <button class="btn btn-primary btn-sm">
                                    <i class="bi bi-save me-1"></i>Simpan Pengaturan
                                </button>
                            </div>
                        </div>
                    </div>
                    @endif


                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Simulasi penyimpanan pengaturan
    const saveButton = document.querySelector('.btn-primary');
    if (saveButton) {
        saveButton.addEventListener('click', function() {
            this.innerHTML = '<i class="bi bi-check me-1"></i>Tersimpan';
            this.classList.remove('btn-primary');
            this.classList.add('btn-success');
            
            setTimeout(() => {
                this.innerHTML = '<i class="bi bi-save me-1"></i>Simpan Pengaturan';
                this.classList.remove('btn-success');
                this.classList.add('btn-primary');
            }, 2000);
        });
    }
});
</script>
@endsection 