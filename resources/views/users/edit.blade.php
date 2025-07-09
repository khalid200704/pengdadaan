@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Main Content -->
        <div class="col-12 col-md-12 bg-light min-vh-100">
            <div class="d-flex justify-content-between align-items-center p-4 border-bottom">
                <div>
                    <h5 class="fw-bold mb-1" style="font-family: 'Segoe UI', 'Roboto', 'Arial', sans-serif; color: #222;">Edit User</h5>
                    <span class="text-muted" style="font-family: 'Segoe UI', 'Roboto', 'Arial', sans-serif;">Form pengeditan data pengguna</span>
                </div>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                </a>
            </div>
            <div class="container-fluid mt-4">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body p-4">
                                @if($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <ul class="mb-0">
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>
                                @endif

                                <form action="{{ route('users.update', $user) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Nama <span class="text-danger">*</span></label>
                                                <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" 
                                                       value="{{ old('nama', $user->nama) }}" placeholder="Masukkan nama lengkap" required>
                                                @error('nama')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                                       value="{{ old('email', $user->email) }}" placeholder="contoh@email.com" required>
                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Password <small class="text-muted">(isi jika ingin ganti)</small></label>
                                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" 
                                                       placeholder="Minimal 6 karakter">
                                                @error('password')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Konfirmasi Password</label>
                                                <input type="password" name="password_confirmation" class="form-control" 
                                                       placeholder="Ulangi password jika mengubah">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Role <span class="text-danger">*</span></label>
                                                <select name="role" class="form-select @error('role') is-invalid @enderror" required>
                                                    <option value="">Pilih Role</option>
                                                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                                                    <option value="division_head" {{ old('role', $user->role) == 'division_head' ? 'selected' : '' }}>Division Head</option>
                                                    <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                                                </select>
                                                @error('role')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Divisi <span class="text-danger">*</span></label>
                                                <select name="divisi" class="form-select @error('divisi') is-invalid @enderror" required>
                                                    <option value="">Pilih Divisi</option>
                                                    <option value="IT & Teknologi" {{ old('divisi', $user->divisi) == 'IT & Teknologi' ? 'selected' : '' }}>IT & Teknologi</option>
                                                    <option value="Finance & Akuntansi" {{ old('divisi', $user->divisi) == 'Finance & Akuntansi' ? 'selected' : '' }}>Finance & Akuntansi</option>
                                                    <option value="Marketing & Sales" {{ old('divisi', $user->divisi) == 'Marketing & Sales' ? 'selected' : '' }}>Marketing & Sales</option>
                                                    <option value="Human Resources" {{ old('divisi', $user->divisi) == 'Human Resources' ? 'selected' : '' }}>Human Resources</option>
                                                    <option value="Operations" {{ old('divisi', $user->divisi) == 'Operations' ? 'selected' : '' }}>Operations</option>
                                                    <option value="Legal & Compliance" {{ old('divisi', $user->divisi) == 'Legal & Compliance' ? 'selected' : '' }}>Legal & Compliance</option>
                                                    <option value="Research & Development" {{ old('divisi', $user->divisi) == 'Research & Development' ? 'selected' : '' }}>Research & Development</option>
                                                    <option value="Customer Service" {{ old('divisi', $user->divisi) == 'Customer Service' ? 'selected' : '' }}>Customer Service</option>
                                                </select>
                                                @error('divisi')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label fw-semibold">Jabatan <span class="text-danger">*</span></label>
                                        <input type="text" name="jabatan" class="form-control @error('jabatan') is-invalid @enderror" 
                                               value="{{ old('jabatan', $user->jabatan) }}" placeholder="Contoh: Staff, Manager, Supervisor" required>
                                        @error('jabatan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
                                            <i class="bi bi-x-circle me-2"></i>Batal
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-check-circle me-2"></i>Update User
                                        </button>
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