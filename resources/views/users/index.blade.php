@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-12 bg-light min-vh-100">
            <div class="d-flex justify-content-between align-items-center p-4 border-bottom">
                <div>
                    <h5 class="fw-bold mb-1" style="font-family: 'Segoe UI', 'Roboto', 'Arial', sans-serif; color: #222;">Daftar User</h5>
                    <span class="text-muted" style="font-family: 'Segoe UI', 'Roboto', 'Arial', sans-serif;">Semua data user sistem</span>
                </div>
            </div>
            <div class="container-fluid mt-4">
                <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Tambah User</a>
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-primary text-white fw-bold d-flex align-items-center">
                        <i class="bi bi-person me-2"></i> Daftar User
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Divisi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->nama }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->role }}</td>
                                        <td>{{ $user->divisi }}</td>
                                        <td>
                                            <a href="{{ route('users.show', $user) }}" class="btn btn-info btn-sm">
                                                <i class="bi bi-eye me-1"></i> Detail
                                            </a>
                                            <a href="{{ route('users.edit', $user) }}" class="btn btn-warning btn-sm">
                                                <i class="bi bi-pencil me-1"></i> Edit
                                            </a>
                                            <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus user?')">
                                                    <i class="bi bi-trash me-1"></i> Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 