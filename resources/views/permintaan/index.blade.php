@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-12 bg-light min-vh-100">
            <div class="d-flex justify-content-between align-items-center p-4 border-bottom">
                <div>
                    <h5 class="fw-bold mb-1" style="font-family: 'Segoe UI', 'Roboto', 'Arial', sans-serif; color: #222;">
                        @if(auth()->user()->canManageBudget())
                            Daftar Permintaan
                        @else
                            Permintaan Saya
                        @endif
                    </h5>
                    <span class="text-muted" style="font-family: 'Segoe UI', 'Roboto', 'Arial', sans-serif;">
                        @if(auth()->user()->canManageBudget())
                            Semua data permintaan barang/jasa
                        @else
                            Permintaan yang Anda buat
                        @endif
                    </span>
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

                <a href="{{ route('permintaan.create') }}" class="btn btn-primary mb-3">Buat Permintaan</a>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
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
                                    <td>Rp {{ number_format($permintaan->total_estimasi, 0, ',', '.') }}</td>
                                    <td>{{ $permintaan->tanggal_permintaan ? $permintaan->tanggal_permintaan->format('d/m/Y H:i') : '-' }}</td>
                                    <td>
                                        @if($permintaan->status_progress === 'dalam_proses')
                                            <span class="badge bg-warning">Dalam Proses</span>
                                        @else
                                            <span class="badge bg-success">Selesai</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('permintaan.show', $permintaan) }}" class="btn btn-sm btn-info">Detail</a>
                                        @if($permintaan->status === 'menunggu_persetujuan' && auth()->id() === $permintaan->user_id)
                                            <a href="{{ route('permintaan.edit', $permintaan) }}" class="btn btn-sm btn-warning">Edit</a>
                                            <form action="{{ route('permintaan.destroy', $permintaan) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus permintaan?')">Hapus</button>
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
@endsection 