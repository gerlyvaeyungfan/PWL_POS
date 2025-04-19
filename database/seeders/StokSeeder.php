<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'stok_id' => 1,
                'supplier_id' => 2,
                'barang_id' => 1,
                'user_id' => 3,
                'stok_jumlah' => 5,
                'stok_tanggal' => '2025-03-25 16:22:22',
            ],
            [
                'stok_id' => 2,
                'supplier_id' => 2,
                'barang_id' => 2,
                'user_id' => 3,
                'stok_jumlah' => 28,
                'stok_tanggal' => '2025-04-19 13:22:37',
            ],
            [
                'stok_id' => 3,
                'supplier_id' => 2,
                'barang_id' => 3,
                'user_id' => 3,
                'stok_jumlah' => 35,
                'stok_tanggal' => '2025-04-04 13:28:11',
            ],
            [
                'stok_id' => 4,
                'supplier_id' => 2,
                'barang_id' => 4,
                'user_id' => 3,
                'stok_jumlah' => 22,
                'stok_tanggal' => '2025-04-15 00:01:17',
            ],
            [
                'stok_id' => 5,
                'supplier_id' => 2,
                'barang_id' => 5,
                'user_id' => 3,
                'stok_jumlah' => 76,
                'stok_tanggal' => '2025-04-19 14:55:55',
            ],
            [
                'stok_id' => 6,
                'supplier_id' => 1,
                'barang_id' => 6,
                'user_id' => 3,
                'stok_jumlah' => 65,
                'stok_tanggal' => '2025-04-06 08:33:00',
            ],
            [
                'stok_id' => 7,
                'supplier_id' => 1,
                'barang_id' => 7,
                'user_id' => 3,
                'stok_jumlah' => 27,
                'stok_tanggal' => '2025-04-09 14:41:39',
            ],
            [
                'stok_id' => 8,
                'supplier_id' => 1,
                'barang_id' => 8,
                'user_id' => 3,
                'stok_jumlah' => 7,
                'stok_tanggal' => '2025-04-01 09:33:53',
            ],
            [
                'stok_id' => 9,
                'supplier_id' => 1,
                'barang_id' => 9,
                'user_id' => 3,
                'stok_jumlah' => 87,
                'stok_tanggal' => '2025-03-27 06:19:33',
            ],
            [
                'stok_id' => 10,
                'supplier_id' => 1,
                'barang_id' => 10,
                'user_id' => 3,
                'stok_jumlah' => 76,
                'stok_tanggal' => '2025-03-29 02:14:23',
            ],
            [
                'stok_id' => 11,
                'supplier_id' => 3,
                'barang_id' => 11,
                'user_id' => 3,
                'stok_jumlah' => 89,
                'stok_tanggal' => '2025-03-25 11:47:38',
            ],
            [
                'stok_id' => 12,
                'supplier_id' => 3,
                'barang_id' => 12,
                'user_id' => 3,
                'stok_jumlah' => 69,
                'stok_tanggal' => '2025-04-05 22:46:22',
            ],
            [
                'stok_id' => 13,
                'supplier_id' => 3,
                'barang_id' => 13,
                'user_id' => 3,
                'stok_jumlah' => 27,
                'stok_tanggal' => '2025-04-03 14:29:09',
            ],
            [
                'stok_id' => 14,
                'supplier_id' => 3,
                'barang_id' => 14,
                'user_id' => 3,
                'stok_jumlah' => 6,
                'stok_tanggal' => '2025-04-01 15:10:35',
            ],
            [
                'stok_id' => 15,
                'supplier_id' => 3,
                'barang_id' => 15,
                'user_id' => 3,
                'stok_jumlah' => 10,
                'stok_tanggal' => '2025-03-30 11:39:27',
            ]
        ];
        DB::table('t_stok')->insert($data);
    }
}
