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
    \DB::table('companies')->insert([
        [
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => null,
            'company_name'=> 'Coca-Cola',
            'street_address' => '123 Coca-Cola St., Atlanta, GA',
            'representative_name' => 'James Quincey',
        ],
        [
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => null,
            'company_name'=> 'サントリー',
            'street_address' => '東京都港区台場2-3-3',
             'representative_name' => '新浪 剛史',
        ],
        [
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => null,
            'company_name'=> 'キリン',
            'street_address' => '東京都中野区中野4-10-2',
            'representative_name' => '磯崎功典',
        ],
    ]);
    }
}
