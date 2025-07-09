@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-12 bg-light min-vh-100">
            <div class="d-flex justify-content-between align-items-center p-4 border-bottom">
                <div>
                    <h5 class="fw-bold mb-1">Buat Persetujuan</h5>
                    <span class="text-muted">Form persetujuan permintaan</span>
                </div>
                <div>
                    <a href="{{ route('persetujuan.index') }}" class="btn btn-secondary">Kembali</a>
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

                                <form action="{{ route('persetujuan.store') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="permintaan_id" class="form-label">Permintaan *</label>
                                        <select name="permintaan_id" id="permintaan_id" class="form-control" required>
                                            <option value="">Pilih Permintaan</option>
                                            @foreach($permintaans as $permintaan)
                                                <option value="{{ $permintaan->id }}">
                                                    {{ $permintaan->nomor_permintaan }} - {{ $permintaan->judul_permintaan }} ({{ $permintaan->user->nama ?? '-' }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status *</label>
                                        <select name="status" id="status" class="form-control" required>
                                            <option value="">Pilih Status</option>
                                            <option value="disetujui">Disetujui</option>
                                            <option value="ditolak">Ditolak</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="catatan" class="form-label">Keterangan</label>
                                        <textarea name="catatan" id="catatan" class="form-control" rows="3"></textarea>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <button type="submit" class="btn btn-primary">Simpan Persetujuan</button>
                                        <a href="{{ route('persetujuan.index') }}" class="btn btn-secondary">Batal</a>
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