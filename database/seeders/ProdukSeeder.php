<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    public function run(): void
    {
        // Dinonaktifkan — produk sekarang diisi manual lewat form Create
        // Produk::factory()->count(100)->create();
    }
}
