<?php

namespace App\Http\Controllers;

use App\Models\Permintaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermintaanController extends Controller
{
    public function index()
    {
        // Jika user adalah admin atau division head, tampilkan semua permintaan
        if (auth()->user()->canManageBudget()) {
            $permintaans = Permintaan::with(['user'])
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        } else {
            // Jika user biasa, hanya tampilkan permintaan yang dia buat
            $permintaans = Permintaan::with(['user'])
                ->where('user_id', auth()->id())
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        }
        
        return view('permintaan.index', compact('permintaans'));
    }

    public function create()
    {
        return view('permintaan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_permintaan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'total_estimasi' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string',
        ]);

        $tahun = date('Y');
        $userDivisi = auth()->user()->divisi;
        
        // Cek budget divisi user
        $budget = \App\Models\Budget::where('tahun', $tahun)
            ->where('nama_budget', 'like', '%' . $userDivisi . '%')
            ->first();
            
        if (!$budget || $budget->tersisa < $request->total_estimasi) {
            return redirect()->back()->withInput()->withErrors(['total_estimasi' => 'Budget tidak mencukupi untuk permintaan ini.']);
        }

        // Generate nomor permintaan
        $lastPermintaan = Permintaan::orderBy('id', 'desc')->first();
        $lastNumber = $lastPermintaan ? intval(substr($lastPermintaan->nomor_permintaan, -3)) : 0;
        $newNumber = $lastNumber + 1;
        $nomorPermintaan = 'REQ-' . $tahun . '-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        $permintaan = Permintaan::create([
            'nomor_permintaan' => $nomorPermintaan,
            'user_id' => Auth::id(),
            'judul_permintaan' => $request->judul_permintaan,
            'deskripsi' => $request->deskripsi,
            'total_estimasi' => $request->total_estimasi,
            'status' => 'menunggu_persetujuan',
            'keterangan' => $request->keterangan,
            'tanggal_permintaan' => now(),
        ]);

        // Update budget (kurangi tersisa, tambah terpakai)
        $budget->terpakai += $request->total_estimasi;
        $budget->tersisa = $budget->total_budget - $budget->terpakai;
        $budget->save();

        return redirect()->route('permintaan.index')->with('success', 'Permintaan berhasil dibuat');
    }

    public function show(Permintaan $permintaan)
    {
        $permintaan->load(['user', 'approver']);
        return view('permintaan.show', compact('permintaan'));
    }

    public function edit(Permintaan $permintaan)
    {
        // Cek apakah user adalah pemilik permintaan atau admin/division head
        if ($permintaan->user_id !== auth()->id() && !auth()->user()->canManageBudget()) {
            return redirect()->route('permintaan.index')->with('error', 'Anda tidak memiliki akses untuk mengedit permintaan ini');
        }

        if ($permintaan->status !== 'menunggu_persetujuan') {
            return redirect()->route('permintaan.index')->with('error', 'Permintaan tidak dapat diedit');
        }

        return view('permintaan.edit', compact('permintaan'));
    }

    public function update(Request $request, Permintaan $permintaan)
    {
        if ($permintaan->status !== 'menunggu_persetujuan') {
            return redirect()->route('permintaan.index')->with('error', 'Permintaan tidak dapat diedit');
        }

        $request->validate([
            'judul_permintaan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'total_estimasi' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string',
        ]);

        $permintaan->update([
            'judul_permintaan' => $request->judul_permintaan,
            'deskripsi' => $request->deskripsi,
            'total_estimasi' => $request->total_estimasi,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('permintaan.index')->with('success', 'Permintaan berhasil diperbarui');
    }

    public function destroy(Permintaan $permintaan)
    {
        // Cek apakah user adalah pemilik permintaan atau admin/division head
        if ($permintaan->user_id !== auth()->id() && !auth()->user()->canManageBudget()) {
            return redirect()->route('permintaan.index')->with('error', 'Anda tidak memiliki akses untuk menghapus permintaan ini');
        }

        if ($permintaan->status !== 'menunggu_persetujuan') {
            return redirect()->route('permintaan.index')->with('error', 'Permintaan tidak dapat dihapus');
        }

        $permintaan->delete();
        return redirect()->route('permintaan.index')->with('success', 'Permintaan berhasil dihapus');
    }
} 