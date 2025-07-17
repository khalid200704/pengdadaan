@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-12 bg-light min-vh-100">
            <div class="d-flex justify-content-between align-items-center p-4 border-bottom">
                <div>
                    <h5 class="fw-bold mb-1" style="font-family: 'Segoe UI', 'Roboto', 'Arial', sans-serif; color: #222;">Tambah Budget Baru</h5>
                    <span class="text-muted" style="font-family: 'Segoe UI', 'Roboto', 'Arial', sans-serif;">Buat budget baru untuk divisi</span>
                </div>
                <a href="{{ route('budgets.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                </a>
            </div>

            <div class="container-fluid mt-4">
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

                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body p-4">
                                <form action="{{ route('budgets.store') }}" method="POST">
                                    @csrf
                                    
                                    <div class="mb-3">
                                        <label for="nama_budget" class="form-label fw-semibold">Nama Budget <span class="text-danger">*</span></label>
                                        <select name="nama_budget" id="nama_budget" class="form-select @error('nama_budget') is-invalid @enderror" required>
                                            <option value="">Pilih Divisi</option>
                                            <option value="Budget IT & Teknologi" {{ old('nama_budget') == 'Budget IT & Teknologi' ? 'selected' : '' }}>Budget IT & Teknologi</option>
                                            <option value="Budget Finance & Akuntansi" {{ old('nama_budget') == 'Budget Finance & Akuntansi' ? 'selected' : '' }}>Budget Finance & Akuntansi</option>
                                            <option value="Budget Marketing & Sales" {{ old('nama_budget') == 'Budget Marketing & Sales' ? 'selected' : '' }}>Budget Marketing & Sales</option>
                                            <option value="Budget Human Resources" {{ old('nama_budget') == 'Budget Human Resources' ? 'selected' : '' }}>Budget Human Resources</option>
                                            <option value="Budget Operations" {{ old('nama_budget') == 'Budget Operations' ? 'selected' : '' }}>Budget Operations</option>
                                            <option value="Budget Legal & Compliance" {{ old('nama_budget') == 'Budget Legal & Compliance' ? 'selected' : '' }}>Budget Legal & Compliance</option>
                                            <option value="Budget Research & Development" {{ old('nama_budget') == 'Budget Research & Development' ? 'selected' : '' }}>Budget Research & Development</option>
                                            <option value="Budget Customer Service" {{ old('nama_budget') == 'Budget Customer Service' ? 'selected' : '' }}>Budget Customer Service</option>
                                        </select>
                                        @error('nama_budget')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="tahun" class="form-label fw-semibold">Tahun <span class="text-danger">*</span></label>
                                        <select name="tahun" id="tahun" class="form-select @error('tahun') is-invalid @enderror" required>
                                            <option value="">Pilih Tahun</option>
                                            @for($year = date('Y'); $year <= date('Y') + 5; $year++)
                                                <option value="{{ $year }}" {{ old('tahun') == $year ? 'selected' : '' }}>{{ $year }}</option>
                                            @endfor
                                        </select>
                                        @error('tahun')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="total_budget" class="form-label fw-semibold">Total Budget (Rp) <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text">Rp</span>
                                            <input type="number" name="total_budget" id="total_budget" 
                                                   value="{{ old('total_budget') }}" step="1000" min="0" max="1000000000000000"
                                                   class="form-control @error('total_budget') is-invalid @enderror" 
                                                   placeholder="0" required>
                                        </div>
                                        <small id="total_budget_text" class="text-muted"></small>
                                        <script>
                                        function terbilang(nilai) {
                                            var satuan = ["", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas"];
                                            nilai = parseInt(nilai, 10);
                                            if (isNaN(nilai) || nilai === 0) return "";
                                            if (nilai < 12) return satuan[nilai];
                                            if (nilai < 20) return terbilang(nilai - 10) + " belas";
                                            if (nilai < 100) return terbilang(Math.floor(nilai / 10)) + " puluh " + terbilang(nilai % 10);
                                            if (nilai < 200) return "seratus " + terbilang(nilai - 100);
                                            if (nilai < 1000) return terbilang(Math.floor(nilai / 100)) + " ratus " + terbilang(nilai % 100);
                                            if (nilai < 2000) return "seribu " + terbilang(nilai - 1000);
                                            if (nilai < 1000000) return terbilang(Math.floor(nilai / 1000)) + " ribu " + terbilang(nilai % 1000);
                                            if (nilai < 1000000000) return terbilang(Math.floor(nilai / 1000000)) + " juta " + terbilang(nilai % 1000000);
                                            if (nilai < 1000000000000) return terbilang(Math.floor(nilai / 1000000000)) + " milyar " + terbilang(nilai % 1000000000);
                                            if (nilai < 1000000000000000) return terbilang(Math.floor(nilai / 1000000000000)) + " triliun " + terbilang(nilai % 1000000000000);
                                            return "";
                                        }
                                        document.addEventListener('DOMContentLoaded', function() {
                                            const input = document.getElementById('total_budget');
                                            const text = document.getElementById('total_budget_text');
                                            if(input && text) {
                                                input.addEventListener('input', function() {
                                                    let angka = this.value;
                                                    let terbilangText = terbilang(angka);
                                                    text.textContent = terbilangText ? (terbilangText.trim() + ' rupiah') : '';
                                                });
                                                if(input.value) text.textContent = terbilang(input.value).trim() + ' rupiah';
                                            }
                                        });
                                        </script>
                                        @error('total_budget')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="keterangan" class="form-label fw-semibold">Keterangan</label>
                                        <textarea name="keterangan" id="keterangan" rows="3" 
                                                  class="form-control @error('keterangan') is-invalid @enderror"
                                                  placeholder="Tambahkan keterangan budget (opsional)">{{ old('keterangan') }}</textarea>
                                        @error('keterangan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('budgets.index') }}" class="btn btn-outline-secondary">
                                            <i class="bi bi-x-circle me-2"></i>Batal
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-check-circle me-2"></i>Simpan Budget
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