@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Edit Saldo Pendanaan</h1>
    <form action="{{ route('saldos.update', $saldo) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Tahun</label>
            <input type="number" name="tahun" class="form-control" value="{{ $saldo->tahun }}" required>
        </div>
        <div class="mb-3">
            <label>Total</label>
            <input type="number" name="total" class="form-control" value="{{ $saldo->total }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('saldos.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection 