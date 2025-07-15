<?php

namespace App\Http\Controllers;

use App\Models\Permintaan;

use App\Models\Persetujuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LaporanPengadaanController extends Controller
{
    public function index()
    {
        $tahun = request('tahun', date('Y'));
        $bulan = request('bulan', date('m'));

        // Statistik permintaan
        $statistikPermintaan = [
            'total' => Permintaan::whereYear('tanggal_permintaan', $tahun)->count(),
            'disetujui' => Permintaan::where('status', 'disetujui')->whereYear('tanggal_permintaan', $tahun)->count(),
            'ditolak' => Permintaan::where('status', 'ditolak')->whereYear('tanggal_permintaan', $tahun)->count(),
            'menunggu' => Permintaan::where('status', 'menunggu_persetujuan')->whereYear('tanggal_permintaan', $tahun)->count(),
        ];

        // Total nilai permintaan
        $totalNilaiPermintaan = Permintaan::where('status', 'disetujui')
            ->whereYear('tanggal_permintaan', $tahun)
            ->sum('total_estimasi');

        // Permintaan per bulan
        $permintaanPerBulan = [];
        for ($i = 1; $i <= 12; $i++) {
            $permintaanPerBulan[$i] = Permintaan::whereYear('tanggal_permintaan', $tahun)
                ->whereMonth('tanggal_permintaan', $i)
                ->count();
        }

        // Permintaan terbaru
        $permintaanTerbaru = Permintaan::with(['user'])
            ->whereYear('tanggal_permintaan', $tahun)
            ->orderBy('tanggal_permintaan', 'desc')
            ->limit(10)
            ->get();



        // Data persetujuan
        $persetujuans = Persetujuan::with(['permintaan.user', 'disetujuiOleh'])
            ->whereYear('tanggal', $tahun)
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('laporan-pengadaan.index', compact(
            'statistikPermintaan',
            'totalNilaiPermintaan',
            'permintaanPerBulan',
            'permintaanTerbaru',
            'persetujuans',
            'tahun',
            'bulan'
        ));
    }

    public function create()
    {
        return view('laporan-pengadaan.create');
    }

    public function store(Request $request)
    {
        // Logic untuk menyimpan laporan
        return redirect()->route('laporan-pengadaan.index')->with('success', 'Laporan berhasil dibuat');
    }

    public function show($id)
    {
        // Ambil data persetujuan beserta relasi permintaan, user, diterimaOleh, dan progress updates
        $laporanPengadaan = \App\Models\Persetujuan::with([
            'permintaan.user',
            'permintaan.progressUpdates.user',
            'disetujuiOleh',
        ])->findOrFail($id);
        return view('laporan-pengadaan.show', compact('laporanPengadaan'));
    }

    public function edit($id)
    {
        // Logic untuk edit laporan
        return view('laporan-pengadaan.edit');
    }

    public function update(Request $request, $id)
    {
        // Logic untuk update laporan
        return redirect()->route('laporan-pengadaan.index')->with('success', 'Laporan berhasil diperbarui');
    }

    public function destroy($id)
    {
        // Logic untuk hapus laporan
        return redirect()->route('laporan-pengadaan.index')->with('success', 'Laporan berhasil dihapus');
    }
} 