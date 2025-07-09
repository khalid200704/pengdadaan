<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaksi;
use Carbon\Carbon;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Transaksi pengeluaran untuk tahun 2025
        $transaksis = [
            [
                'tanggal' => '2025-01-15',
                'tipe' => 'pengeluaran',
                'jumlah' => -50000000, // 50 Juta (negatif untuk pengeluaran)
                'keterangan' => 'Pembelian peralatan IT',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'tanggal' => '2025-02-20',
                'tipe' => 'pengeluaran',
                'jumlah' => -75000000, // 75 Juta
                'keterangan' => 'Pembelian furniture kantor',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'tanggal' => '2025-03-10',
                'tipe' => 'pengeluaran',
                'jumlah' => -30000000, // 30 Juta
                'keterangan' => 'Pembelian software lisensi',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'tanggal' => '2025-04-05',
                'tipe' => 'pengeluaran',
                'jumlah' => -25000000, // 25 Juta
                'keterangan' => 'Pembelian peralatan kantor',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'tanggal' => '2025-05-12',
                'tipe' => 'pengeluaran',
                'jumlah' => -40000000, // 40 Juta
                'keterangan' => 'Pembelian peralatan keamanan',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];

        foreach ($transaksis as $transaksi) {
            Transaksi::create($transaksi);
        }
    }
} 