<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $data = [
            [
                'supplier_id' => 1,
                'supplier_kode' => '1',
                'supplier_nama' => 'CV Sumber Rejeki',
                'supplier_alamat' => 'Jalan Raya Bogor KM 20, Jakarta Timur',
            ],
            [
                'supplier_id' => 2,
                'supplier_kode' => '2',
                'supplier_nama' => 'PT Global Elektronik',
                'supplier_alamat' => 'Jl. Pemuda No. 45, Surabaya, Jawa Timur',

            ],
            [
                'supplier_id' => 3,
                'supplier_kode' => '3',
                'supplier_nama' => 'PT Mitra Pakaian Nusantara',
                'supplier_alamat' => 'Jl. Siliwangi No. 88, Bandung, Jawa Barat',
            ]
        ];
        DB::table('m_supplier')->insert($data);
    }
}
