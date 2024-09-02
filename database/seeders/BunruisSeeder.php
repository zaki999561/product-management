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
            'str'=> 'コーラ',
        ],
        [
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => null,
            'str'=> 'お茶',
        ],
        [
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => null,
            'str'=> '水',
        ],
    ]);
    }
}
