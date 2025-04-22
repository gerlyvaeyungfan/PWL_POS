<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierModel extends Model
{
    use HasFactory;

    protected $table = 'm_supplier'; // Nama tabel yang digunakan oleh model ini
    protected $primaryKey = 'supplier_id'; // Primary key dari tabel

    protected $fillable = ['supplier_kode', 'supplier_nama', 'supplier_alamat'];

    // Relasi ke BarangModel (1 Supplier dapat memiliki banyak Barang)
    public function barang()
    {
        return $this->hasMany(BarangModel::class, 'supplier_id', 'supplier_id');
    }
}
