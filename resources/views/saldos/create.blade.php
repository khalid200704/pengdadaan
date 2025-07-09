@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Tambah Saldo Pendanaan</h1>
    <form action="{{ route('saldos.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Tahun</label>
            <input type="number" name="tahun" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Total</label>
            <input type="number" name="total" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('saldos.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection 