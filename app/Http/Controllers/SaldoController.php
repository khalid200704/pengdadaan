<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Saldo;

class SaldoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $saldos = Saldo::orderBy('tahun', 'desc')->get();
        return view('saldos.index', compact('saldos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('saldos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tahun' => 'required|integer',
            'total' => 'required|integer',
        ]);
        Saldo::create($request->only(['tahun', 'total']));
        return redirect()->route('saldos.index')->with('success', 'Saldo berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Saldo $saldo)
    {
        return view('saldos.edit', compact('saldo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Saldo $saldo)
    {
        $request->validate([
            'tahun' => 'required|integer',
            'total' => 'required|integer',
        ]);
        $saldo->update($request->only(['tahun', 'total']));
        return redirect()->route('saldos.index')->with('success', 'Saldo berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Saldo $saldo)
    {
        $saldo->delete();
        return redirect()->route('saldos.index')->with('success', 'Saldo berhasil dihapus');
    }
}
