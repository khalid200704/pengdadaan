<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BudgetController extends Controller
{


    public function index()
    {
        if (!auth()->user()->canManageBudget()) {
            abort(403, 'Unauthorized action.');
        }
        
        $budgets = Budget::orderBy('tahun', 'desc')
            ->orderBy('nama_budget', 'asc')
            ->paginate(10);
        return view('budgets.index', compact('budgets'));
    }

    public function create()
    {
        if (!auth()->user()->canManageBudget()) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('budgets.create');
    }

    public function store(Request $request)
    {
        if (!auth()->user()->canManageBudget()) {
            abort(403, 'Unauthorized action.');
        }
        
        $validator = Validator::make($request->all(), [
            'nama_budget' => 'required|string|max:255',
            'total_budget' => 'required|numeric|min:0',
            'tahun' => 'required|integer|min:2020|max:2030',
            'keterangan' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Set terpakai to 0 for new budget and calculate tersisa
        $request->merge([
            'terpakai' => 0,
            'tersisa' => $request->total_budget
        ]);

        Budget::create($request->all());

        return redirect()->route('budgets.index')
            ->with('success', 'Budget berhasil ditambahkan');
    }

    public function show(Budget $budget)
    {
        if (!auth()->user()->canManageBudget()) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('budgets.show', compact('budget'));
    }

    public function edit(Budget $budget)
    {
        if (!auth()->user()->canManageBudget()) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('budgets.edit', compact('budget'));
    }

    public function update(Request $request, Budget $budget)
    {
        if (!auth()->user()->canManageBudget()) {
            abort(403, 'Unauthorized action.');
        }
        
        $validator = Validator::make($request->all(), [
            'nama_budget' => 'required|string|max:255',
            'total_budget' => 'required|numeric|min:0',
            'terpakai' => 'required|numeric|min:0',
            'tahun' => 'required|integer|min:2020|max:2030',
            'keterangan' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Calculate tersisa
        $request->merge([
            'tersisa' => $request->total_budget - $request->terpakai
        ]);

        $budget->update($request->all());

        return redirect()->route('budgets.index')
            ->with('success', 'Budget berhasil diperbarui');
    }

    public function destroy(Budget $budget)
    {
        if (!auth()->user()->canManageBudget()) {
            abort(403, 'Unauthorized action.');
        }
        
        $budget->delete();

        return redirect()->route('budgets.index')
            ->with('success', 'Budget berhasil dihapus');
    }
} 