<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;

class BarangModel extends Model
{
    use HasFactory;

    protected $table = 'm_barang'; // Nama tabel yang digunakan oleh model ini
    protected $primaryKey = 'barang_id'; // Primary key dari tabel
    protected $fillable = ['kategori_id', 'barang_kode', 'barang_nama', 'harga_beli', 'harga_jual', 'foto', 'created_at', 'updated_at']; // Kolom yang dapat diisi

    public function foto(): Attribute
    {
        return Attribute::make(
            get: fn ($foto) => url('/storage/barang/' . $foto),
        );
    }

    // Relasi ke KategoriModel (1 Barang hanya memiliki 1 Kategori)
    public function kategori()
    {
        return $this->belongsTo(KategoriModel::class, 'kategori_id', 'kategori_id');
    }

    // Relasi ke SupplierModel (1 Barang hanya memiliki 1 Supplier)
    public function supplier()
    {
        return $this->belongsTo(SupplierModel::class, 'supplier_id', 'supplier_id');
    }
}
