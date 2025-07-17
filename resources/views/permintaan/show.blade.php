@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-10 offset-md-1 bg-light min-vh-100">
            <div class="d-flex justify-content-between align-items-center p-4 border-bottom">
                <div>
                    <h5 class="fw-bold mb-1">Detail Permintaan</h5>
                    <span class="text-muted">{{ $permintaan->nomor_permintaan }}</span>
                </div>
                <a href="{{ route('permintaan.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-1"></i>Kembali
                </a>
            </div>
            <div class="container-fluid mt-4">
                @if(auth()->id() === $permintaan->user_id && $permintaan->status === 'disetujui' && $permintaan->status_progress === 'dalam_proses')
                <div class="row mb-4" id="form-progress">
                    <div class="col-12">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-primary text-white fw-bold">
                                <i class="bi bi-upload me-2"></i>Tambah Progress
                            </div>
                            <div class="card-body">
                                <div class="col-12 col-md-8 mx-auto">
                                    <div class="mb-2">
                                        <label for="deskripsi_progress" class="form-label fw-semibold">Deskripsi Progress <span class="text-danger">*</span></label>
                                        <textarea form="progressForm" name="deskripsi_progress" id="deskripsi_progress" class="form-control @error('deskripsi_progress') is-invalid @enderror" rows="2" required>{{ old('deskripsi_progress') }}</textarea>
                                        @error('deskripsi_progress')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-2">
                                        <label for="file" class="form-label fw-semibold">Upload File (opsional)</label>
                                        <input form="progressForm" type="file" name="file" id="file" class="form-control @error('file') is-invalid @enderror" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
                                        <small class="text-muted">Maksimal 2MB. Format: pdf, jpg, jpeg, png, doc, docx</small>
                                        @error('file')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="d-flex gap-2 justify-content-end mt-3">
                                        <form action="{{ route('permintaan.completeProgress', $permintaan) }}" method="POST" onsubmit="return confirm('Tandai progress sebagai selesai?')">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-success"><i class="bi bi-check2-circle me-1"></i>Progress Selesai</button>
                                        </form>
                                        <form id="progressForm" action="{{ route('permintaan.addProgressUpdate', $permintaan) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <button type="submit" class="btn btn-primary"><i class="bi bi-upload me-1"></i>Tambah Progress</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-primary text-white fw-bold">
                                <i class="bi bi-info-circle me-2"></i>Informasi Permintaan
                            </div>
                            <div class="card-body">
                                <div class="mb-3"><label class="form-label fw-semibold">No. Permintaan</label><div>{{ $permintaan->nomor_permintaan }}</div></div>
                                <div class="mb-3"><label class="form-label fw-semibold">Judul</label><div>{{ $permintaan->judul_permintaan }}</div></div>
                                <div class="mb-3"><label class="form-label fw-semibold">Pemohon</label><div>{{ $permintaan->user->nama ?? '-' }}</div></div>
                                <div class="mb-3"><label class="form-label fw-semibold">Divisi</label><div>{{ $permintaan->user->divisi ?? '-' }}</div></div>
                                <div class="mb-3"><label class="form-label fw-semibold">Tanggal</label><div>{{ $permintaan->tanggal_permintaan ? $permintaan->tanggal_permintaan->format('d/m/Y H:i') : '-' }}</div></div>
                                <div class="mb-3"><label class="form-label fw-semibold">Deskripsi</label><div class="text-muted">{{ $permintaan->deskripsi }}</div></div>
                                @if($permintaan->keterangan)
                                <div class="mb-3"><label class="form-label fw-semibold">Keterangan</label><div class="text-muted">{{ $permintaan->keterangan }}</div></div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-info text-white fw-bold">
                                <i class="bi bi-bar-chart me-2"></i>Status & Persetujuan
                            </div>
                            <div class="card-body">
                                <div class="mb-3"><label class="form-label fw-semibold">Status</label><div>
                                    @switch($permintaan->status)
                                        @case('menunggu_persetujuan')<span class="badge bg-warning">Menunggu Persetujuan</span>@break
                                        @case('disetujui')<span class="badge bg-success">Disetujui</span>@break
                                        @case('ditolak')<span class="badge bg-danger">Ditolak</span>@break
                                        @default <span class="badge bg-secondary">{{ $permintaan->status }}</span>
                                    @endswitch
                                </div></div>
                                <div class="mb-3"><label class="form-label fw-semibold">Total Estimasi</label><div class="fs-5 fw-bold text-success">Rp {{ number_format($permintaan->total_estimasi, 0, ',', '.') }}</div></div>
                                <div class="mb-3"><label class="form-label fw-semibold">Disetujui Oleh</label><div>{{ $permintaan->approver->nama ?? '-' }}</div></div>
                                <div class="mb-3"><label class="form-label fw-semibold">Tanggal Persetujuan</label><div>{{ $permintaan->approved_at ? $permintaan->approved_at->format('d/m/Y H:i') : '-' }}</div></div>
                                <div class="mb-3"><label class="form-label fw-semibold">Catatan Approver</label><div>{{ $permintaan->catatan_approver ?? '-' }}</div></div>
                                <div class="mb-3"><label class="form-label fw-semibold">Status Progress</label><div>
                                    @if($permintaan->status_progress === 'dalam_proses')<span class="badge bg-warning">Dalam Proses</span>@else<span class="badge bg-success">Selesai</span>@endif
                                </div></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Riwayat Progress Updates -->
                @if($permintaan->progressUpdates->count() > 0)
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-secondary text-white fw-bold">
                                <i class="bi bi-clock-history me-2"></i>Riwayat Progress Updates
                            </div>
                            <div class="card-body">
                                <div class="timeline">
                                    @foreach($permintaan->progressUpdates->sortByDesc('created_at') as $update)
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
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 