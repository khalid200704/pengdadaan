@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-12 bg-light min-vh-100">
            <div class="d-flex justify-content-between align-items-center p-4 border-bottom">
                <div>
                    <h5 class="fw-bold mb-1">@if(auth()->user()->canManageBudget()) Daftar Permintaan @else Permintaan Saya @endif</h5>
                    <span class="text-muted">@if(auth()->user()->canManageBudget()) Semua data permintaan barang/jasa @else Permintaan yang Anda buat @endif</span>
                </div>
                <a href="{{ route('permintaan.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-1"></i>Buat Permintaan
                </a>
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
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-primary text-white fw-bold d-flex align-items-center">
                        <i class="bi bi-file-earmark-plus me-2"></i> Daftar Permintaan
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>Status</th>
                                        <th>Total Estimasi</th>
                                        <th>Tanggal</th>
                                        <th>Status Progress</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($permintaans as $permintaan)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $permintaan->judul_permintaan }}</td>
                                            <td>
                                                @switch($permintaan->status)
                                                    @case('menunggu_persetujuan')
                                                        <span class="badge bg-warning text-dark"><i class="bi bi-hourglass-split me-1"></i>Menunggu</span>
                                                        @break
                                                    @case('disetujui')
                                                        <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>Disetujui</span>
                                                        @break
                                                    @case('ditolak')
                                                        <span class="badge bg-danger"><i class="bi bi-x-circle me-1"></i>Ditolak</span>
                                                        @break
                                                    @default
                                                        <span class="badge bg-secondary">{{ $permintaan->status }}</span>
                                                @endswitch
                                            </td>
                                            <td class="fw-bold text-success">Rp {{ number_format($permintaan->total_estimasi, 0, ',', '.') }}</td>
                                            <td><span class="badge bg-secondary">{{ $permintaan->tanggal_permintaan ? $permintaan->tanggal_permintaan->format('d/m/Y H:i') : '-' }}</span></td>
                                            <td>
                                                @if($permintaan->status_progress === 'dalam_proses')
                                                    <span class="badge bg-warning text-dark"><i class="bi bi-arrow-repeat me-1"></i>Dalam Proses</span>
                                                @else
                                                    <span class="badge bg-info text-dark"><i class="bi bi-check2-all me-1"></i>Selesai</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($permintaan->status === 'disetujui' && $permintaan->status_progress === 'dalam_proses' && auth()->id() === $permintaan->user_id)
                                                    <a href="{{ route('permintaan.show', $permintaan) }}#form-progress" class="btn btn-sm btn-primary" title="Update Progress"><i class="bi bi-upload"></i> Update Progress</a>
                                                @else
                                                    <a href="{{ route('permintaan.show', $permintaan) }}" class="btn btn-sm btn-info" title="Detail"><i class="bi bi-eye"></i></a>
                                                @endif
                                                @if($permintaan->status === 'menunggu_persetujuan' && auth()->id() === $permintaan->user_id)
                                                    <a href="{{ route('permintaan.edit', $permintaan) }}" class="btn btn-sm btn-warning" title="Edit"><i class="bi bi-pencil-square"></i></a>
                                                    <form action="{{ route('permintaan.destroy', $permintaan) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus" onclick="return confirm('Yakin hapus permintaan?')"><i class="bi bi-trash"></i></button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
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
    </div>
</div>
@endsection 