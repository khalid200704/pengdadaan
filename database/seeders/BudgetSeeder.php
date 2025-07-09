<?php

namespace Database\Seeders;

use App\Models\Budget;
use Illuminate\Database\Seeder;

class BudgetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Budget::create([
            'nama_budget' => 'Budget IT 2024',
            'total_budget' => 50000000,
            'terpakai' => 15000000,
            'tersisa' => 35000000,
            'tahun' => '2024',
            'keterangan' => 'Budget untuk pengadaan perangkat IT'
        ]);

        Budget::create([
            'nama_budget' => 'Budget HR 2024',
            'total_budget' => 25000000,
            'terpakai' => 8000000,
            'tersisa' => 17000000,
            'tahun' => '2024',
            'keterangan' => 'Budget untuk pengadaan perangkat HR'
        ]);

        Budget::create([
            'nama_budget' => 'Budget Finance 2024',
            'total_budget' => 30000000,
            'terpakai' => 12000000,
            'tersisa' => 18000000,
            'tahun' => '2024',
            'keterangan' => 'Budget untuk pengadaan perangkat Finance'
        ]);

        Budget::create([
            'nama_budget' => 'Budget IT 2025',
            'total_budget' => 100000000,
            'terpakai' => 0,
            'tersisa' => 100000000,
            'tahun' => '2025',
            'keterangan' => 'Budget untuk pengadaan perangkat IT tahun 2025'
        ]);

        Budget::create([
            'nama_budget' => 'Budget HR 2025',
            'total_budget' => 50000000,
            'terpakai' => 0,
            'tersisa' => 50000000,
            'tahun' => '2025',
            'keterangan' => 'Budget untuk pengadaan perangkat HR tahun 2025'
        ]);

        Budget::create([
            'nama_budget' => 'Budget Finance 2025',
            'total_budget' => 75000000,
            'terpakai' => 0,
            'tersisa' => 75000000,
            'tahun' => '2025',
            'keterangan' => 'Budget untuk pengadaan perangkat Finance tahun 2025'
        ]);
    }
} 