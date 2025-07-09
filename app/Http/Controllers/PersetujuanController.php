<?php

namespace App\Http\Controllers;

use App\Models\Permintaan;
use App\Models\Persetujuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PersetujuanController extends Controller
{


    public function index()
    {
        if (!auth()->user()->canApprove()) {
            abort(403, 'Unauthorized action.');
        }
        
        $permintaans = Permintaan::where('status', 'menunggu_persetujuan')
            ->with(['user'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('persetujuan.index', compact('permintaans'));
    }

    public function create()
    {
        if (!auth()->user()->canApprove()) {
            abort(403, 'Unauthorized action.');
        }
        
        $permintaans = Permintaan::where('status', 'menunggu_persetujuan')->get();
        return view('persetujuan.create', compact('permintaans'));
    }

    public function store(Request $request)
    {
        if (!auth()->user()->canApprove()) {
            abort(403, 'Unauthorized action.');
        }
        
        $request->validate([
            'permintaan_id' => 'required|exists:permintaan,id',
            'status' => 'required|in:disetujui,ditolak',
            'catatan' => 'nullable|string',
        ]);

        $permintaan = Permintaan::findOrFail($request->permintaan_id);
        
        if ($permintaan->status !== 'menunggu_persetujuan') {
            return redirect()->route('persetujuan.index')->with('error', 'Permintaan sudah diproses');
        }

        // Update status permintaan
        $permintaan->update([
            'status' => $request->status,
            'approved_by' => Auth::id(),
            'approved_at' => now(),
            'catatan_approver' => $request->catatan,
        ]);

        // Buat record persetujuan
        Persetujuan::create([
            'permintaan_id' => $permintaan->id,
            'status' => $request->status,
            'catatan' => $request->catatan,
            'disetujui_oleh' => Auth::id(),
        ]);

        return redirect()->route('persetujuan.index')->with('success', 'Persetujuan berhasil diproses');
    }

    public function show(Persetujuan $persetujuan)
    {
        if (!auth()->user()->canApprove()) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('persetujuan.show', compact('persetujuan'));
    }

    public function edit(Persetujuan $persetujuan)
    {
        if (!auth()->user()->canApprove()) {
            abort(403, 'Unauthorized action.');
        }
        
        if ($persetujuan->permintaan->status !== 'menunggu_persetujuan') {
            return redirect()->route('persetujuan.index')->with('error', 'Persetujuan tidak dapat diedit');
        }

        return view('persetujuan.edit', compact('persetujuan'));
    }

    public function update(Request $request, Persetujuan $persetujuan)
    {
        if (!auth()->user()->canApprove()) {
            abort(403, 'Unauthorized action.');
        }
        
        if ($persetujuan->permintaan->status !== 'menunggu_persetujuan') {
            return redirect()->route('persetujuan.index')->with('error', 'Persetujuan tidak dapat diedit');
        }

        $request->validate([
            'status' => 'required|in:disetujui,ditolak',
            'catatan' => 'nullable|string',
        ]);

        // Update status permintaan
        $persetujuan->permintaan->update([
            'status' => $request->status,
            'approved_by' => Auth::id(),
            'approved_at' => now(),
            'catatan_approver' => $request->catatan,
        ]);

        // Update persetujuan
        $persetujuan->update([
            'status' => $request->status,
            'catatan' => $request->catatan,
            'disetujui_oleh' => Auth::id(),
        ]);

        return redirect()->route('persetujuan.index')->with('success', 'Persetujuan berhasil diperbarui');
    }

    public function destroy(Persetujuan $persetujuan)
    {
        if (!auth()->user()->canApprove()) {
            abort(403, 'Unauthorized action.');
        }
        
        if ($persetujuan->permintaan->status !== 'menunggu_persetujuan') {
            return redirect()->route('persetujuan.index')->with('error', 'Persetujuan tidak dapat dihapus');
        }

        $persetujuan->delete();
        return redirect()->route('persetujuan.index')->with('success', 'Persetujuan berhasil dihapus');
    }
} 