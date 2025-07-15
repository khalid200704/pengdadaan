@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-12 bg-light min-vh-100">
            <div class="d-flex justify-content-between align-items-center p-4 border-bottom">
                <div>
                    <h5 class="fw-bold mb-1" style="font-family: 'Segoe UI', 'Roboto', 'Arial', sans-serif; color: #222;">Laporan Pengadaan</h5>
                    <span class="text-muted" style="font-family: 'Segoe UI', 'Roboto', 'Arial', sans-serif;">Data laporan pengadaan barang/jasa</span>
                </div>
            </div>
            <div class="container-fluid mt-4">
                @if($persetujuans->count())
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="border-0 px-4 py-3">No</th>
                                            <th class="border-0 px-4 py-3">No. Permintaan</th>
                                            <th class="border-0 px-4 py-3">Judul</th>
                                            <th class="border-0 px-4 py-3">Pemohon</th>
                                            <th class="border-0 px-4 py-3">Divisi</th>
                                            <th class="border-0 px-4 py-3">Tanggal</th>
                                            <th class="border-0 px-4 py-3">Total Estimasi</th>
                                            <th class="border-0 px-4 py-3">Status</th>
                                            <th class="border-0 px-4 py-3">Disetujui Oleh</th>
                                            <th class="border-0 px-4 py-3">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($persetujuans as $item)
                                        <tr>
                                            <td class="px-4 py-3">{{ $loop->iteration }}</td>
                                            <td class="px-4 py-3">
                                                <span class="fw-semibold">{{ $item->permintaan->nomor_permintaan }}</span>
                                            </td>
                                            <td class="px-4 py-3">{{ $item->permintaan->judul_permintaan }}</td>
                                            <td class="px-4 py-3">{{ $item->permintaan->user->nama ?? '-' }}</td>
                                            <td class="px-4 py-3">
                                                <span class="badge bg-secondary">{{ $item->permintaan->user->divisi ?? '-' }}</span>
                                            </td>
                                            <td class="px-4 py-3">{{ $item->permintaan->tanggal_permintaan ? $item->permintaan->tanggal_permintaan->format('d/m/Y') : '-' }}</td>
                                            <td class="px-4 py-3">
                                                <span class="fw-semibold text-success">Rp {{ number_format($item->permintaan->total_estimasi, 0, ',', '.') }}</span>
                                            </td>
                                            <td class="px-4 py-3">
                                                @switch($item->permintaan->status)
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
                                                        <span class="badge bg-secondary">{{ $item->permintaan->status }}</span>
                                                @endswitch
                                            </td>
                                            <td class="px-4 py-3">{{ $item->disetujuiOleh->nama ?? '-' }}</td>
                                            <td class="px-4 py-3">
                                                <button type="button" class="btn btn-sm btn-outline-info" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#detailModal{{ $item->id }}">
                                                    <i class="bi bi-eye"></i> Detail
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Detail Modals -->
                    @foreach($persetujuans as $item)
                    <div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $item->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title" id="detailModalLabel{{ $item->id }}">
                                        <i class="bi bi-file-earmark-text me-2"></i>
                                        Detail Permintaan - {{ $item->permintaan->nomor_permintaan }}
                                    </h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6 class="fw-bold text-primary mb-3">Informasi Permintaan</h6>
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td width="40%"><strong>No. Permintaan:</strong></td>
                                                    <td>{{ $item->permintaan->nomor_permintaan }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Judul:</strong></td>
                                                    <td>{{ $item->permintaan->judul_permintaan }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Pemohon:</strong></td>
                                                    <td>{{ $item->permintaan->user->nama ?? '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Divisi:</strong></td>
                                                    <td>{{ $item->permintaan->user->divisi ?? '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Tanggal:</strong></td>
                                                    <td>{{ $item->permintaan->tanggal_permintaan ? $item->permintaan->tanggal_permintaan->format('d/m/Y H:i') : '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Status:</strong></td>
                                                    <td>
                                                        @switch($item->permintaan->status)
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
                                                                <span class="badge bg-secondary">{{ $item->permintaan->status }}</span>
                                                        @endswitch
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Total Estimasi:</strong></td>
                                                    <td><span class="fw-bold text-success">Rp {{ number_format($item->permintaan->total_estimasi, 0, ',', '.') }}</span></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <h6 class="fw-bold text-success mb-3">Informasi Persetujuan</h6>
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td width="40%"><strong>Disetujui Oleh:</strong></td>
                                                    <td>{{ $item->disetujuiOleh->nama ?? '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Tanggal Persetujuan:</strong></td>
                                                    <td>{{ $item->tanggal ? $item->tanggal->format('d/m/Y H:i') : '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Status Persetujuan:</strong></td>
                                                    <td>
                                                        @if($item->status == 'disetujui')
                                                            <span class="badge bg-success">Disetujui</span>
                                                        @else
                                                            <span class="badge bg-danger">Ditolak</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Catatan Approver:</strong></td>
                                                    <td>{{ $item->catatan ?? '-' }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-4">
                                        <h6 class="fw-bold text-info mb-2">Deskripsi:</h6>
                                        <div class="bg-light p-3 rounded">
                                            {{ $item->permintaan->deskripsi ?? '-' }}
                                        </div>
                                    </div>

                                    {{-- Status Progress --}}
                                    @if($item->permintaan)
                                    <div class="mt-4">
                                        <h6>Status Progress:</h6>
                                        <p class="text-muted mb-1">
                                            @if($item->permintaan->status_progress === 'dalam_proses')
                                                <span class="badge bg-warning">Dalam Proses</span>
                                            @else
                                                <span class="badge bg-success">Selesai</span>
                                            @endif
                                        </p>
                                    </div>
                                    @endif

                                    {{-- Riwayat Progress Updates --}}
                                    @if($item->permintaan && $item->permintaan->progressUpdates->count() > 0)
                                    <div class="mt-4">
                                        <h6>Riwayat Progress Updates:</h6>
                                        <div class="timeline">
                                            @foreach($item->permintaan->progressUpdates->sortByDesc('created_at') as $update)
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
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach


                @else
                <div class="alert alert-info text-center mt-4">
                    <i class="bi bi-inbox display-4 d-block mb-3"></i>
                    <h5>Belum ada data laporan pengadaan</h5>
                    <p class="mb-0">Data laporan akan muncul setelah ada permintaan yang diproses</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
