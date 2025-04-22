<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriModel extends Model
{
    use HasFactory;

    protected $table = 'm_kategori'; // Nama tabel yang digunakan oleh model ini
    protected $primaryKey = 'kategori_id'; // Primary key dari tabel
    public $timestamps = true;

    protected $fillable = [
        'kategori_kode',    // Menambahkan kategori_kode ke dalam fillable
        'kategori_nama'
    ];

    // Relasi ke BarangModel (1 Kategori dapat memiliki banyak Barang)
    public function barang()
    {
        return $this->hasMany(BarangModel::class, 'kategori_id', 'kategori_id');
    }
}
