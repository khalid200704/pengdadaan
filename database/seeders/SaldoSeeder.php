<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Saldo;

class SaldoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Saldo untuk tahun 2025
        Saldo::create([
            'tahun' => 2025,
            'total' => 1000000000, // 1 Miliar
        ]);

        // Saldo untuk tahun 2024 (jika diperlukan)
        Saldo::create([
            'tahun' => 2024,
            'total' => 800000000, // 800 Juta
        ]);
    }
} 