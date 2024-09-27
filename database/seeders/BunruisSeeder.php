<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BunruisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    \DB::table('bunruis')->insert([
        [
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => null,
            'str'=> 'Coca-Cola',
        ],
        [
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => null,
            'str'=> 'サントリー',
        ],
        [
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => null,
            'str'=> 'キリン',
        ],
    ]);
    }
}
