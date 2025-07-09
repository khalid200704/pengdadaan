@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Main Content -->
        <div class="col-12 col-md-12 bg-light min-vh-100">
            <div class="d-flex justify-content-between align-items-center p-4 border-bottom">
                <div>
                    <h5 class="fw-bold mb-1">Detail User</h5>
                    <span class="text-muted">Informasi detail pengguna sistem</span>
                </div>
            </div>
            <div class="container-fluid mt-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <p><strong>Nama:</strong> {{ $user->nama }}</p>
                                <p><strong>Email:</strong> {{ $user->email }}</p>
                                <p><strong>Role:</strong> {{ $user->role }}</p>
                                <p><strong>Divisi:</strong> {{ $user->divisi }}</p>
                            </div>
                        </div>
                        <a href="{{ route('users.index') }}" class="btn btn-secondary mt-3">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 