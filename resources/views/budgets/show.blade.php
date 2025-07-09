@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Detail Budget</h1>
            <div class="flex space-x-2">
                <a href="{{ route('budgets.edit', $budget) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                    Edit
                </a>
                <a href="{{ route('budgets.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                    Kembali
                </a>
            </div>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900">{{ $budget->nama_budget }}</h2>
                <p class="text-sm text-gray-600">Tahun {{ $budget->tahun }}</p>
            </div>
            
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Budget</h3>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nama Budget</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $budget->nama_budget }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Tahun</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $budget->tahun }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Total Budget</label>
                                <p class="mt-1 text-lg font-semibold text-gray-900">Rp {{ number_format($budget->total_budget, 0, ',', '.') }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Keterangan</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $budget->keterangan ?? 'Tidak ada keterangan' }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Status Penggunaan</h3>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Terpakai</label>
                                <p class="mt-1 text-lg font-semibold text-red-600">Rp {{ number_format($budget->terpakai, 0, ',', '.') }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Tersisa</label>
                                <p class="mt-1 text-lg font-semibold text-green-600">Rp {{ number_format($budget->tersisa, 0, ',', '.') }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Persentase Terpakai</label>
                                <div class="mt-2">
                                    <div class="w-full bg-gray-200 rounded-full h-3">
                                        <div class="bg-blue-600 h-3 rounded-full" style="width: {{ $budget->persentase_terpakai }}%"></div>
                                    </div>
                                    <p class="mt-1 text-sm text-gray-600">{{ $budget->persentase_terpakai }}%</p>
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Tanggal Dibuat</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $budget->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Terakhir Diupdate</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $budget->updated_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 