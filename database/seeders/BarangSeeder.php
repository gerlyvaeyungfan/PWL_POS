<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'barang_id' => 1,
                'kategori_id' => 1,
                'barang_kode' => '1',
                'barang_nama' => 'Smartphone Samsung A14',
                'harga_beli' => 1900000,
                'harga_jual' => 2400000,
            ],
            [
                'barang_id' => 2,
                'barang_kode' => '2',
                'kategori_id' => 1,
                'barang_nama' => 'Laptop Asus VivoBook 14',
                'harga_beli' => 5500000,
                'harga_jual' => 6200000,

            ],
            [
                'barang_id' => 3,
                'barang_kode' => '3',
                'kategori_id' => 1,
                'barang_nama' => 'Headset Bluetooth JBL',
                'harga_beli' => 350000,
                'harga_jual' => 450000,

            ],
            [
                'barang_id' => 4,
                'barang_kode' => '4',
                'kategori_id' => 1,
                'barang_nama' => 'Smart TV LG 42 Inch',
                'harga_beli' => 3200000,
                'harga_jual' => 3750000,

            ],
            [
                'barang_id' => 5,
                'barang_kode' => '5',
                'kategori_id' => 1,
                'barang_nama' => 'Kabel Data Type-C',
                'harga_beli' => 15000,
                'harga_jual' => 25000,

            ],
            [
                'barang_id' => 6,
                'kategori_id' => 2,
                'barang_kode' => '6',
                'barang_nama' => 'Indomie Goreng Spesial 1 dus (40 pcs)',
                'harga_beli' => 85000,
                'harga_jual' => 100000,
            ],
            [
                'barang_id' => 7,
                'kategori_id' => 2,
                'barang_kode' => '7',
                'barang_nama' => 'Susu UHT Ultra Milk Coklat 1L',
                'harga_beli' => 13000,
                'harga_jual' => 15000,
            ],
            [
                'barang_id' => 8,
                'kategori_id' => 2,
                'barang_kode' => '8',
                'barang_nama' => 'Roti Tawar Sari Roti',
                'harga_beli' => 9500,
                'harga_jual' => 12000,
            ],
            [
                'barang_id' => 9,
                'kategori_id' => 2,
                'barang_kode' => '9',
                'barang_nama' => 'Kopi Kapal Api Special Mix 10 Sachet',
                'harga_beli' => 7000,
                'harga_jual' => 9000,
            ],
            [
                'barang_id' => 10,
                'kategori_id' => 2,
                'barang_kode' => '10',
                'barang_nama' => 'Air Mineral Aqua Botol 600ml',
                'harga_beli' => 3500,
                'harga_jual' => 5000,
            ],
            [
                'barang_id' => 11,
                'kategori_id' => 4,
                'barang_kode' => '11',
                'barang_nama' => 'Kemeja Lengan Panjang Pria',
                'harga_beli' => 75000,
                'harga_jual' => 110000,
            ],
            [
                'barang_id' => 12,
                'kategori_id' => 4,
                'barang_kode' => '12',
                'barang_nama' => 'Kaos Polos Katun Combed 30s',
                'harga_beli' => 35000,
                'harga_jual' => 50000,
            ],
            [
                'barang_id' => 13,
                'kategori_id' => 4,
                'barang_kode' => '13',
                'barang_nama' => 'Celana Jeans Wanita',
                'harga_beli' => 95000,
                'harga_jual' => 130000,
            ],
            [
                'barang_id' => 14,
                'kategori_id' => 4,
                'barang_kode' => '14',
                'barang_nama' => 'Jaket Hoodie Unisex',
                'harga_beli' => 100000,
                'harga_jual' => 145000,
            ],
            [
                'barang_id' => 15,
                'kategori_id' => 4,
                'barang_kode' => '15',
                'barang_nama' => 'Baju Anak Laki-Laki (Usia 5-7 th)',
                'harga_beli' => 40000,
                'harga_jual' => 60000,
            ]
        ];
        DB::table('m_barang')->insert($data);
    }
}
