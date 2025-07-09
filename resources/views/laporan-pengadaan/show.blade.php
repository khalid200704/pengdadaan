@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Detail Laporan Pengadaan</h1>
    <div class="card mb-3">
        <div class="card-body">
            <p><strong>Permintaan:</strong> #{{ $laporanPengadaan->permintaan->id ?? '-' }}</p>
            <p><strong>Diterima Oleh:</strong> {{ $laporanPengadaan->diterimaOleh->nama ?? '-' }}</p>
            <p><strong>Tanggal Diterima:</strong> {{ $laporanPengadaan->tanggal_diterima }}</p>
            <p><strong>Status Penerimaan:</strong> {{ ucfirst($laporanPengadaan->status_penerimaan) }}</p>
        </div>
    </div>
    <a href="{{ route('laporan-pengadaan.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection 