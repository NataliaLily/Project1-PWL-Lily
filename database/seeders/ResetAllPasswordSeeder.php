<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResetAllPasswordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $password = password_hash('12345678', PASSWORD_DEFAULT);
        $query = "update users set password = '${password}'";
        DB::select($query);
    }
}
