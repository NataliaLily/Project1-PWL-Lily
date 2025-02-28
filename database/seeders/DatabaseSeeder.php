<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use DB;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        DB::table('users')->insert([
            'name' => 'Joko',
            'email' => 'joko@gmail.com',
            'password' => password_hash('12345678',PASSWORD_DEFAULT)
        ]);

        DB::table('kategoris')->insert([
            'code' => '123',
            'name' => 'Kategori 1',
        ]);

        //php artisan db:seed
    }
}
