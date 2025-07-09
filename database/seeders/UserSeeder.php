<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Daftar divisi tetap
        $divisions = [
            'IT & Teknologi',
            'Finance & Akuntansi',
            'Marketing & Sales',
            'Human Resources',
            'Operations',
            'Legal & Compliance',
            'Research & Development',
            'Customer Service',
        ];

        // Admin
        User::create([
            'nama' => 'Administrator',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'divisi' => $divisions[0],
            'jabatan' => 'System Administrator',
        ]);

        // Division Head
        User::create([
            'nama' => 'Kepala Divisi Finance',
            'email' => 'finance.head@example.com',
            'password' => Hash::make('password'),
            'role' => 'division_head',
            'divisi' => $divisions[1],
            'jabatan' => 'Finance Manager',
        ]);
        User::create([
            'nama' => 'Kepala Divisi Marketing',
            'email' => 'marketing.head@example.com',
            'password' => Hash::make('password'),
            'role' => 'division_head',
            'divisi' => $divisions[2],
            'jabatan' => 'Marketing Manager',
        ]);

        // User Biasa
        User::create([
            'nama' => 'Staff IT',
            'email' => 'it.staff@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'divisi' => $divisions[0],
            'jabatan' => 'IT Support',
        ]);
        User::create([
            'nama' => 'Staff HR',
            'email' => 'hr.staff@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'divisi' => $divisions[3],
            'jabatan' => 'HR Staff',
        ]);
        User::create([
            'nama' => 'Staff Operations',
            'email' => 'ops.staff@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'divisi' => $divisions[4],
            'jabatan' => 'Operations Staff',
        ]);
        User::create([
            'nama' => 'Staff Legal',
            'email' => 'legal.staff@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'divisi' => $divisions[5],
            'jabatan' => 'Legal Staff',
        ]);
        User::create([
            'nama' => 'Staff R&D',
            'email' => 'rnd.staff@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'divisi' => $divisions[6],
            'jabatan' => 'R&D Staff',
        ]);
        User::create([
            'nama' => 'Staff Customer Service',
            'email' => 'cs.staff@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'divisi' => $divisions[7],
            'jabatan' => 'Customer Service Staff',
        ]);
    }
} 