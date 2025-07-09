@extends('layouts.app')

@section('content')
@if(!auth()->user()->canManageBudget())
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-12 bg-light min-vh-100">
                <div class="d-flex justify-content-center align-items-center min-vh-100">
                    <div class="text-center">
                        <div class="alert alert-danger" role="alert">
                            <h4 class="alert-heading">Akses Ditolak</h4>
                            <p>Maaf, Anda tidak memiliki izin untuk mengakses halaman Budget. Hanya Admin dan Kepala Divisi yang dapat mengelola Budget.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-12 bg-light min-vh-100">
            <div class="d-flex justify-content-between align-items-center p-4 border-bottom">
                <div>
                    <h5 class="fw-bold mb-1" style="font-family: 'Segoe UI', 'Roboto', 'Arial', sans-serif; color: #222;">Data Budget</h5>
                    <span class="text-muted" style="font-family: 'Segoe UI', 'Roboto', 'Arial', sans-serif;">Kelola budget divisi</span>
                </div>
                <a href="{{ route('budgets.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>Tambah Budget
                </a>
            </div>

            <div class="container-fluid mt-4">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="card border-0 shadow-sm">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="border-0 px-4 py-3">Nama Budget</th>
                                        <th class="border-0 px-4 py-3">Tahun</th>
                                        <th class="border-0 px-4 py-3">Total Budget</th>
                                        <th class="border-0 px-4 py-3">Terpakai</th>
                                        <th class="border-0 px-4 py-3">Tersisa</th>
                                        <th class="border-0 px-4 py-3">Persentase</th>
                                        <th class="border-0 px-4 py-3">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($budgets as $budget)
                                    <tr>
                                        <td class="px-4 py-3">
                                            <div class="fw-semibold">{{ $budget->nama_budget }}</div>
                                            @if($budget->keterangan)
                                                <small class="text-muted">{{ $budget->keterangan }}</small>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3">
                                            <span class="badge bg-secondary">{{ $budget->tahun }}</span>
                                        </td>
                                        <td class="px-4 py-3">
                                            <span class="fw-semibold text-success">Rp {{ number_format($budget->total_budget, 0, ',', '.') }}</span>
                                        </td>
                                        <td class="px-4 py-3">
                                            <span class="text-warning">Rp {{ number_format($budget->terpakai, 0, ',', '.') }}</span>
                                        </td>
                                        <td class="px-4 py-3">
                                            <span class="text-info">Rp {{ number_format($budget->tersisa, 0, ',', '.') }}</span>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="d-flex align-items-center">
                                                <div class="progress me-2" style="width: 60px; height: 8px;">
                                                    <div class="progress-bar bg-{{ $budget->persentase_terpakai > 80 ? 'danger' : ($budget->persentase_terpakai > 60 ? 'warning' : 'success') }}" 
                                                         style="width: {{ $budget->persentase_terpakai }}%"></div>
                                                </div>
                                                <small class="text-muted">{{ $budget->persentase_terpakai }}%</small>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('budgets.show', $budget) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="{{ route('budgets.edit', $budget) }}" class="btn btn-sm btn-outline-warning">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form action="{{ route('budgets.destroy', $budget) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus budget ini?')">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="px-4 py-4 text-center text-muted">
                                            <i class="bi bi-inbox display-4 d-block mb-3"></i>
                                            <p class="mb-0">Tidak ada data budget</p>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                @if($budgets->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $budgets->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endif
@endsection 