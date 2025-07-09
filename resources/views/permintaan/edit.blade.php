@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-12 bg-light min-vh-100">
            <div class="d-flex justify-content-between align-items-center p-4 border-bottom">
                <div>
                    <h5 class="fw-bold mb-1">Edit Permintaan</h5>
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
                            <div class="card-body">
                                @if($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form action="{{ route('permintaan.update', $permintaan) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="judul_permintaan" class="form-label">Judul Permintaan *</label>
                                        <input type="text" name="judul_permintaan" id="judul_permintaan" class="form-control" value="{{ old('judul_permintaan', $permintaan->judul_permintaan) }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="deskripsi" class="form-label">Deskripsi *</label>
                                        <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4" required>{{ old('deskripsi', $permintaan->deskripsi) }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="total_estimasi" class="form-label">Total Estimasi (Rp) *</label>
                                        <input type="number" name="total_estimasi" id="total_estimasi" class="form-control" value="{{ old('total_estimasi', $permintaan->total_estimasi) }}" min="0" step="0.01" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="keterangan" class="form-label">Keterangan</label>
                                        <textarea name="keterangan" id="keterangan" class="form-control" rows="3">{{ old('keterangan', $permintaan->keterangan) }}</textarea>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <button type="submit" class="btn btn-primary">Update Permintaan</button>
                                        <a href="{{ route('permintaan.index') }}" class="btn btn-secondary">Batal</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 