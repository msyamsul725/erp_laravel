<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HeadLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('head_location')->insert([
            [
                'location_name' => 'Gudang Utama',
                'max_lantai' => 3,
                'max_rak' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'location_name' => 'Gudang Bahan Baku',
                'max_lantai' => 2,
                'max_rak' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'location_name' => 'Gudang Sparepart',
                'max_lantai' => 1,
                'max_rak' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
