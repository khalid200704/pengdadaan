<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Budget;
use App\Models\Permintaan;

use Illuminate\Support\Facades\Hash;

class SampleDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample users
        $users = [
            [
                'nama' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'divisi' => 'IT & Teknologi',
                'jabatan' => 'System Administrator'
            ],
            [
                'nama' => 'Division Head',
                'email' => 'head@example.com',
                'password' => Hash::make('password'),
                'role' => 'division_head',
                'divisi' => 'Finance & Akuntansi',
                'jabatan' => 'Finance Manager'
            ],
            [
                'nama' => 'Marketing Staff',
                'email' => 'marketing@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'divisi' => 'Marketing & Sales',
                'jabatan' => 'Marketing Staff'
            ],
            [
                'nama' => 'HR Staff',
                'email' => 'hr@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'divisi' => 'Human Resources',
                'jabatan' => 'HR Staff'
            ],
            [
                'nama' => 'Operations Staff',
                'email' => 'ops@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'divisi' => 'Operations',
                'jabatan' => 'Operations Staff'
            ],
            [
                'nama' => 'Legal Staff',
                'email' => 'legal@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'divisi' => 'Legal & Compliance',
                'jabatan' => 'Legal Staff'
            ],
            [
                'nama' => 'R&D Staff',
                'email' => 'rd@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'divisi' => 'Research & Development',
                'jabatan' => 'R&D Staff'
            ],
            [
                'nama' => 'CS Staff',
                'email' => 'cs@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'divisi' => 'Customer Service',
                'jabatan' => 'Customer Service Staff'
            ]
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }

        // Create sample vendors
        $vendors = [
            [
                'nama_perusahaan' => 'PT Maju Bersama',
                'alamat' => 'Jl. Sudirman No. 123, Jakarta Pusat',
                'telepon' => '021-5550123',
                'email' => 'info@majubersama.com',
                'npwp' => '01.234.567.8-123.000',
                'keterangan' => 'Vendor terpercaya untuk peralatan kantor'
            ],
            [
                'nama_perusahaan' => 'CV Sukses Mandiri',
                'alamat' => 'Jl. Thamrin No. 456, Jakarta Selatan',
                'telepon' => '021-5550456',
                'email' => 'contact@suksesmandiri.co.id',
                'npwp' => '02.345.678.9-234.000',
                'keterangan' => 'Spesialis perangkat IT dan elektronik'
            ],
            [
                'nama_perusahaan' => 'UD Makmur Jaya',
                'alamat' => 'Jl. Gatot Subroto No. 789, Jakarta Barat',
                'telepon' => '021-5550789',
                'email' => 'sales@makmurjaya.com',
                'npwp' => '03.456.789.0-345.000',
                'keterangan' => 'Penyedia furniture dan dekorasi kantor'
            ]
        ];

        foreach ($vendors as $vendorData) {
            Vendor::create($vendorData);
        }

        // Create sample budgets
        $budgets = [
            [
                'nama_budget' => 'Budget IT & Teknologi',
                'total_budget' => 200000000,
                'terpakai' => 75000000,
                'tahun' => 2024,
                'keterangan' => 'Budget untuk pengembangan IT dan teknologi'
            ],
            [
                'nama_budget' => 'Budget Finance & Akuntansi',
                'total_budget' => 150000000,
                'terpakai' => 45000000,
                'tahun' => 2024,
                'keterangan' => 'Budget untuk operasional finance dan akuntansi'
            ],
            [
                'nama_budget' => 'Budget Marketing & Sales',
                'total_budget' => 300000000,
                'terpakai' => 120000000,
                'tahun' => 2024,
                'keterangan' => 'Budget untuk kegiatan marketing dan sales'
            ],
            [
                'nama_budget' => 'Budget Human Resources',
                'total_budget' => 80000000,
                'terpakai' => 25000000,
                'tahun' => 2024,
                'keterangan' => 'Budget untuk pengembangan SDM dan rekrutmen'
            ],
            [
                'nama_budget' => 'Budget Operations',
                'total_budget' => 120000000,
                'terpakai' => 35000000,
                'tahun' => 2024,
                'keterangan' => 'Budget untuk operasional harian perusahaan'
            ],
            [
                'nama_budget' => 'Budget Legal & Compliance',
                'total_budget' => 60000000,
                'terpakai' => 15000000,
                'tahun' => 2024,
                'keterangan' => 'Budget untuk urusan legal dan compliance'
            ],
            [
                'nama_budget' => 'Budget Research & Development',
                'total_budget' => 250000000,
                'terpakai' => 80000000,
                'tahun' => 2024,
                'keterangan' => 'Budget untuk penelitian dan pengembangan produk'
            ],
            [
                'nama_budget' => 'Budget Customer Service',
                'total_budget' => 70000000,
                'terpakai' => 20000000,
                'tahun' => 2024,
                'keterangan' => 'Budget untuk layanan pelanggan'
            ]
        ];

        foreach ($budgets as $budgetData) {
            Budget::create($budgetData);
        }

        // Create sample permintaan
        $permintaan = [
            [
                'nomor_permintaan' => 'REQ-2024-001',
                'judul_permintaan' => 'Permintaan Laptop untuk Tim IT',
                'deskripsi' => 'Permintaan 5 unit laptop untuk tim IT yang sedang melakukan pengembangan sistem',
                'tanggal_permintaan' => now()->subDays(30),
                'status' => 'disetujui',
                'user_id' => 3, // Marketing Staff
                'total_estimasi' => 75000000
            ],
            [
                'nomor_permintaan' => 'REQ-2024-002',
                'judul_permintaan' => 'Permintaan Printer untuk Divisi Finance',
                'deskripsi' => 'Permintaan 2 unit printer laser untuk divisi finance',
                'tanggal_permintaan' => now()->subDays(20),
                'status' => 'menunggu_persetujuan',
                'user_id' => 4, // HR Staff
                'total_estimasi' => 15000000
            ],
            [
                'nomor_permintaan' => 'REQ-2024-003',
                'judul_permintaan' => 'Permintaan Furniture Kantor',
                'deskripsi' => 'Permintaan meja dan kursi untuk ruang meeting baru',
                'tanggal_permintaan' => now()->subDays(10),
                'status' => 'disetujui',
                'user_id' => 5, // Operations Staff
                'total_estimasi' => 25000000
            ]
        ];

        foreach ($permintaan as $reqData) {
            Permintaan::create($reqData);
        }



        $this->command->info('Sample data has been seeded successfully!');
    }
}
