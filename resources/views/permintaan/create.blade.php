@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Main Content -->
        <div class="col-12 col-md-12 bg-light min-vh-100">
            <div class="d-flex justify-content-between align-items-center p-4 border-bottom">
                <div>
                    <h5 class="fw-bold mb-1">Buat Permintaan Barang</h5>
                    <span class="text-muted">Form pembuatan permintaan barang/jasa</span>
                </div>
            </div>
            <div class="container-fluid mt-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                @if($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form action="{{ route('permintaan.store') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="judul_permintaan" class="form-label">Judul Permintaan *</label>
                                        <input type="text" name="judul_permintaan" id="judul_permintaan" class="form-control" value="{{ old('judul_permintaan') }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="deskripsi" class="form-label">Deskripsi *</label>
                                        <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4" required>{{ old('deskripsi') }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="total_estimasi" class="form-label">Total Estimasi (Rp) *</label>
                                        <input type="number" name="total_estimasi" id="total_estimasi" class="form-control" value="{{ old('total_estimasi') }}" min="0" max="1000000000000000" step="0.01" required>
                                        <small id="total_estimasi_text" class="text-muted"></small>
                                        <script>
                                        function formatRupiah(angka) {
                                            if (!angka) return '';
                                            let number_string = angka.replace(/[^\d]/g, ''),
                                                sisa = number_string.length % 3,
                                                rupiah = number_string.substr(0, sisa),
                                                ribuan = number_string.substr(sisa).match(/\d{3}/g);
                                            if (ribuan) {
                                                rupiah += (sisa ? '.' : '') + ribuan.join('.');
                                            }
                                            return rupiah ? 'Rp ' + rupiah : '';
                                        }
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
                                            if (nilai < 1000000000000000000) return terbilang(Math.floor(nilai / 1000000000000000)) + " kuadriliun " + terbilang(nilai % 1000000000000000);
                                            return "";
                                        }
                                        document.addEventListener('DOMContentLoaded', function() {
                                            const input = document.getElementById('total_estimasi');
                                            const text = document.getElementById('total_estimasi_text');
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
                                    </div>
                                    <div class="mb-3">
                                        <label for="keterangan" class="form-label">Keterangan</label>
                                        <textarea name="keterangan" id="keterangan" class="form-control" rows="3">{{ old('keterangan') }}</textarea>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <button type="submit" class="btn btn-primary">Simpan Permintaan</button>
                                        <a href="{{ route('permintaan.index') }}" class="btn btn-secondary">Batal</a>
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