<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'penjualan_id' => 1,
                'user_id' => '3',
                'penjualan_kode' => '1',
                'pembeli' => 'Budi Santoso',
                'penjualan_tanggal' => '2025-04-05 09:15:00',
            ],
            [
                'penjualan_id' => 2,
                'user_id' => '3',
                'penjualan_kode' => '2',
                'pembeli' => 'Dewi Lestari',
                'penjualan_tanggal' => '2025-04-06 13:22:00',
            ],
            [
                'penjualan_id' => 3,
                'user_id' => '3',
                'penjualan_kode' => '3',
                'pembeli' => 'Rizky Maulana',
                'penjualan_tanggal' => '2025-04-07 16:47:00',
            ],
            [
                'penjualan_id' => 4,
                'user_id' => '3',
                'penjualan_kode' => '4',
                'pembeli' => 'Siti Aminah',
                'penjualan_tanggal' => '2025-04-08 10:33:00',
            ],
            [
                'penjualan_id' => 5,
                'user_id' => '3',
                'penjualan_kode' => '5',
                'pembeli' => 'Andi Pratama',
                'penjualan_tanggal' => '2025-04-09 14:12:00',
            ],
            [
                'penjualan_id' => 6,
                'user_id' => '3',
                'penjualan_kode' => '6',
                'pembeli' => 'Yuniarti Sari',
                'penjualan_tanggal' => '2025-04-10 12:44:00',
            ],
            [
                'penjualan_id' => 7,
                'user_id' => '3',
                'penjualan_kode' => '7',
                'pembeli' => 'Galang Saputra',
                'penjualan_tanggal' => '2025-04-11 15:01:00',
            ],
            [
                'penjualan_id' => 8,
                'user_id' => '3',
                'penjualan_kode' => '8',
                'pembeli' => 'Intan Nurhaliza',
                'penjualan_tanggal' => '2025-04-12 11:27:00',
            ],
            [
                'penjualan_id' => 9,
                'user_id' => '3',
                'penjualan_kode' => '9',
                'pembeli' => 'Fajar Ramadan',
                'penjualan_tanggal' => '2025-04-13 17:19:00',
            ],
            [
                'penjualan_id' => 10,
                'user_id' => '3',
                'penjualan_kode' => '10',
                'pembeli' => 'Rani Oktavia',
                'penjualan_tanggal' => '2025-04-14 14:55:00',
            ]
        ];
        DB::table('t_penjualan')->insert($data);
    }
}
