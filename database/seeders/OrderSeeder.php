<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Order;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Pastikan ada data users terlebih dahulu
         User::factory(10)->create(); // Buat 10 user dummy jika belum ada

         Order::factory()->count(1000)->create();
    }
}
