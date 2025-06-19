<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
// use DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        #seeder untuk kategori
        DB::table('kategoris')->insert([
            [
                'code' => 'K001',
                'name' => 'Gaji',
                'user_id' => 1
            ],
            [
                'code' => 'K002',
                'name' => 'Makan',
                'user_id' => 1
            ]
        ]);
        DB::table('wallets')->insert([
            [
                'code' => 'W001',
                'name' => 'Uang Cash',
                'user_id' => 1
            ]

        ]);
        DB::table('transaksis')->insert([
            [
                'deskripsi' => 'Gaji Bulan Maret',
                'nominal' => 10000000,
                'wallet_id' => 1,
                'kategori_id' => 1,
                'in_out' => 'in',
                'tanggal' => '2025-03-20',
                'user_id' => 1
            ],
            [
                'deskripsi' => 'Makan Siang - Nasi Padang',
                'nominal' => 15000,
                'wallet_id' => 1,
                'kategori_id' => 2,
                'in_out' => 'out',
                'tanggal' => '2025-03-21',
                'user_id' => 1
            ],
        ]);

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        DB::table('users')->insert([
            'name' => 'Joko',
            'email' => 'joko@gmail.com',
            'password' => password_hash('12345678',PASSWORD_DEFAULT),
            'role' => 'admin',
        ]);

        // password
        // email : admin1@gmail
        // password : admin123

        //php artisan db:seed
    }
}
