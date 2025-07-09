@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Buat Laporan Pengadaan</h1>
    <form action="{{ route('laporan-pengadaan.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Permintaan</label>
            <select name="permintaan_id" class="form-control" required>
                <option value="">Pilih Permintaan</option>
                @foreach($permintaans as $permintaan)
                    <option value="{{ $permintaan->id }}">#{{ $permintaan->id }} - {{ $permintaan->user->nama ?? '-' }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Tanggal Diterima</label>
            <input type="date" name="tanggal_diterima" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Status Penerimaan</label>
            <select name="status_penerimaan" class="form-control" required>
                <option value="diterima">Diterima</option>
                <option value="sebagian">Sebagian</option>
                <option value="ditolak">Ditolak</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('laporan-pengadaan.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection 