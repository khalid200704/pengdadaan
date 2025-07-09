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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 