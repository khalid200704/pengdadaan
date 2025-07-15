@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-12 bg-light min-vh-100">
            <div class="d-flex justify-content-between align-items-center p-4 border-bottom">
                <div>
                    <h5 class="fw-bold mb-1">Detail Permintaan</h5>
                    <span class="text-muted">{{ $permintaan->nomor_permintaan }}</span>
                </div>
                <div>
                    <a href="{{ route('permintaan.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
            <div class="container-fluid mt-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="mb-0">Informasi Permintaan</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tr>
                                                <td width="150"><strong>No. Permintaan:</strong></td>
                                                <td>{{ $permintaan->nomor_permintaan }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Judul:</strong></td>
                                                <td>{{ $permintaan->judul_permintaan }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Pemohon:</strong></td>
                                                <td>{{ $permintaan->user->nama ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Divisi:</strong></td>
                                                <td>{{ $permintaan->user->divisi ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Tanggal:</strong></td>
                                                <td>{{ $permintaan->tanggal_permintaan ? $permintaan->tanggal_permintaan->format('d/m/Y H:i') : '-' }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tr>
                                                <td width="150"><strong>Status:</strong></td>
                                                <td>
                                                    @switch($permintaan->status)
                                                        @case('menunggu_persetujuan')
                                                            <span class="badge bg-warning">Menunggu Persetujuan</span>
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
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Total Estimasi:</strong></td>
                                                <td><strong>Rp {{ number_format($permintaan->total_estimasi, 0, ',', '.') }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Disetujui Oleh:</strong></td>
                                                <td>{{ $permintaan->approver->nama ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Tanggal Persetujuan:</strong></td>
                                                <td>{{ $permintaan->approved_at ? $permintaan->approved_at->format('d/m/Y H:i') : '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Catatan Approver:</strong></td>
                                                <td>{{ $permintaan->catatan_approver ?? '-' }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                
                                <div class="mt-4">
                                    <h6>Deskripsi:</h6>
                                    <p class="text-muted">{{ $permintaan->deskripsi }}</p>
                                </div>
                                
                                @if($permintaan->keterangan)
                                <div class="mt-3">
                                    <h6>Keterangan:</h6>
                                    <p class="text-muted">{{ $permintaan->keterangan }}</p>
                                </div>
                                @endif

                                <div class="mt-4">
                                    <h6>Status Progress:</h6>
                                    <p class="text-muted mb-1">
                                        @if($permintaan->status_progress === 'dalam_proses')
                                            <span class="badge bg-warning">Dalam Proses</span>
                                        @else
                                            <span class="badge bg-success">Selesai</span>
                                        @endif
                                    </p>
                                    
                                    @if(auth()->id() === $permintaan->user_id && $permintaan->status === 'disetujui' && $permintaan->status_progress === 'dalam_proses')
                                        <div class="mt-3">
                                            <h6>Tambah Progress Update:</h6>
                                            <form action="{{ route('permintaan.addProgressUpdate', $permintaan) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="deskripsi_progress" class="form-label">Deskripsi Progress:</label>
                                                    <textarea name="deskripsi_progress" id="deskripsi_progress" class="form-control" rows="3" required placeholder="Jelaskan apa yang sudah dikerjakan..."></textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="file" class="form-label">Upload File (Opsional):</label>
                                                    <input type="file" name="file" id="file" class="form-control" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
                                                    <small class="text-muted">Format: PDF, JPG, PNG, DOC, DOCX (Max: 2MB)</small>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Tambah Progress</button>
                                            </form>
                                        </div>
                                        
                                        <div class="mt-3">
                                            <form action="{{ route('permintaan.completeProgress', $permintaan) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-success" onclick="return confirm('Yakin ingin menyelesaikan permintaan ini?')">
                                                    <i class="bi bi-check-circle me-1"></i>Selesai
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>

                                <!-- Riwayat Progress Updates -->
                                @if($permintaan->progressUpdates->count() > 0)
                                <div class="mt-4">
                                    <h6>Riwayat Progress Updates:</h6>
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
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 