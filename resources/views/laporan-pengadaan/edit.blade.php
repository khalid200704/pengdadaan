@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Edit Laporan Pengadaan</h1>
    <form action="{{ route('laporan-pengadaan.update', $laporanPengadaan) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Tanggal Diterima</label>
            <input type="date" name="tanggal_diterima" class="form-control" value="{{ $laporanPengadaan->tanggal_diterima }}" required>
        </div>
        <div class="mb-3">
            <label>Status Penerimaan</label>
            <select name="status_penerimaan" class="form-control" required>
                <option value="diterima" @if($laporanPengadaan->status_penerimaan=='diterima') selected @endif>Diterima</option>
                <option value="sebagian" @if($laporanPengadaan->status_penerimaan=='sebagian') selected @endif>Sebagian</option>
                <option value="ditolak" @if($laporanPengadaan->status_penerimaan=='ditolak') selected @endif>Ditolak</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('laporan-pengadaan.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection 