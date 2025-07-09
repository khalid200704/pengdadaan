<?php

namespace App\Http\Controllers;

use App\Models\Permintaan;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Saldo;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $tahun = date('Y');
        $userDivisi = auth()->user()->divisi;
        
        // Statistik Permintaan
        $statistikPermintaan = [
            'total' => Permintaan::whereYear('tanggal_permintaan', $tahun)->count(),
            'disetujui' => Permintaan::where('status', 'disetujui')->whereYear('tanggal_permintaan', $tahun)->count(),
            'ditolak' => Permintaan::where('status', 'ditolak')->whereYear('tanggal_permintaan', $tahun)->count(),
            'menunggu' => Permintaan::where('status', 'menunggu_persetujuan')->whereYear('tanggal_permintaan', $tahun)->count(),
        ];

        // Total nilai permintaan disetujui
        $totalNilaiDisetujui = Permintaan::where('status', 'disetujui')
            ->whereYear('tanggal_permintaan', $tahun)
            ->sum('total_estimasi');

        // Data untuk pie chart status permintaan
        $permintaanData = [
            'labels' => ['Menunggu Persetujuan', 'Disetujui', 'Ditolak'],
            'data' => [
                $statistikPermintaan['menunggu'],
                $statistikPermintaan['disetujui'],
                $statistikPermintaan['ditolak'],
            ]
        ];

        // Budget Pendanaan (menggunakan Budget sesuai divisi)
        $budget = \App\Models\Budget::where('tahun', $tahun)
            ->where('nama_budget', 'like', '%' . $userDivisi . '%')
            ->first();
        
        $totalBudget = $budget ? $budget->total_budget : 0;
        $totalTerpakai = $budget ? $budget->terpakai : 0;
        $sisaBudget = $budget ? $budget->tersisa : 0;
        
        $saldoPendanaan = [
            'total' => $sisaBudget,
            'total_digunakan' => $totalTerpakai,
            'tahun' => $tahun
        ];

        // Permintaan Terbaru
        $permintaanTerbaru = Permintaan::with(['user'])
            ->whereYear('tanggal_permintaan', $tahun)
            ->orderBy('tanggal_permintaan', 'desc')
            ->limit(5)
            ->get();

        // Aktivitas Mingguan (jumlah permintaan per hari minggu ini)
        $startOfWeek = Carbon::now()->startOfWeek();
        $labels = [];
        $data = [];
        for ($i = 0; $i < 7; $i++) {
            $day = $startOfWeek->copy()->addDays($i);
            $labels[] = $day->format('D');
            $data[] = Permintaan::whereDate('tanggal_permintaan', $day)->count();
        }
        $aktivitasMingguan = [
            'labels' => $labels,
            'data' => $data
        ];

        return view('dashboard', compact(
            'statistikPermintaan',
            'totalNilaiDisetujui',
            'permintaanData',
            'saldoPendanaan',
            'totalBudget',
            'totalTerpakai',
            'permintaanTerbaru',
            'aktivitasMingguan',
            'tahun'
        ));
    }
}
