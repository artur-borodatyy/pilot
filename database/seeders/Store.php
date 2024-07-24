<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Store extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('stores')->insert([
            ['id' => 1, 'title' => 'Nord', 'created_at' => now()->toDateTimeString()],
            ['id' => 2, 'title' => 'West', 'created_at' => now()->toDateTimeString()],
            ['id' => 3, 'title' => 'Ost', 'created_at' => now()->toDateTimeString()],
            ['id' => 4, 'title' => 'Mitte', 'created_at' => now()->toDateTimeString()],
            ['id' => 5, 'title' => 'Süd', 'created_at' => now()->toDateTimeString()],
        ]);
    }
}
