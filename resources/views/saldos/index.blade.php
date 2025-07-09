@extends('layouts.app')
@section('content')
<div class="container">
    <h5 class="fw-bold mb-1">Daftar Saldo Pendanaan</h5>
    <a href="{{ route('saldos.create') }}" class="btn btn-primary mb-3">Tambah Saldo</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Tahun</th>
                <th>Total</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($saldos as $saldo)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $saldo->tahun }}</td>
                <td>Rp.{{ number_format($saldo->total,0,',','.') }}</td>
                <td>
                    <a href="{{ route('saldos.edit', $saldo) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('saldos.destroy', $saldo) }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus saldo?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection 