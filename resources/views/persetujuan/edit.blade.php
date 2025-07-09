@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-12 bg-light min-vh-100">
            <div class="d-flex justify-content-between align-items-center p-4 border-bottom">
                <div>
                    <h5 class="fw-bold mb-1">Edit Persetujuan</h5>
                    <span class="text-muted">{{ $persetujuan->permintaan->nomor_permintaan ?? 'N/A' }}</span>
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

                                <form action="{{ route('persetujuan.update', $persetujuan) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status *</label>
                                        <select name="status" id="status" class="form-control" required>
                                            <option value="">Pilih Status</option>
                                            <option value="disetujui" @if($persetujuan->status=='disetujui') selected @endif>Disetujui</option>
                                            <option value="ditolak" @if($persetujuan->status=='ditolak') selected @endif>Ditolak</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="catatan" class="form-label">Keterangan</label>
                                        <textarea name="catatan" id="catatan" class="form-control" rows="3">{{ $persetujuan->catatan }}</textarea>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <button type="submit" class="btn btn-primary">Update Persetujuan</button>
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