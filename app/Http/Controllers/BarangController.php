<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\KategoriModel;
use App\Models\SupplierModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BarangController extends Controller
{
    // Menampilkan halaman daftar barang
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Barang',
            'list'  => ['Home', 'Barang']
        ];

        $page = (object) [
            'title' => 'Daftar barang yang ada dalam sistem'
        ];

        $activeMenu = 'barang'; // set menu yang sedang aktif

        return view('barang.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
    }

    // Ambil data barang dalam bentuk json untuk datatables
    public function list(Request $request)
    {
        $barangs = BarangModel::select('barang_id', 'barang_kode', 'barang_nama', 'harga_beli', 'harga_jual', 'kategori_id')
            ->with('kategori'); // Mengambil relasi kategori

        return DataTables::of($barangs)
            ->addIndexColumn()
            ->addColumn('aksi', function ($barang) { // menambahkan kolom aksi
                $btn = '<a href="'.url('/barang/' . $barang->barang_id).'" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="'.url('/barang/' . $barang->barang_id . '/edit').'" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="'.url('/barang/'.$barang->barang_id).'">'.
                    csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }

    // Menyimpan data barang baru
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'barang_kode' => 'required|string|max:255|unique:m_barang,barang_kode',
            'barang_nama' => 'required|string|max:255',
            'kategori_id' => 'required|exists:m_kategori,kategori_id',
            'harga_beli' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0',
        ]);

        // Menyimpan data barang
        $barang = new BarangModel();
        $barang->barang_kode = $request->barang_kode; // Menyimpan kode barang
        $barang->barang_nama = $request->barang_nama;
        $barang->kategori_id = $request->kategori_id;
        $barang->harga_beli = $request->harga_beli;
        $barang->harga_jual = $request->harga_jual;
        $barang->save();

        // Redirect ke halaman daftar barang
        return redirect('barang')->with('success', 'Barang berhasil ditambahkan');
    }



    // Menampilkan halaman form tambah barang
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Barang',
            'list'  => ['Home', 'Barang', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah barang baru'
        ];

        $kategori = KategoriModel::all(); // Menampilkan semua kategori

        $activeMenu = 'barang'; // set menu yang sedang aktif

        return view('barang.create', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'kategori' => $kategori, // Menyertakan data kategori
            'activeMenu' => $activeMenu
        ]);
    }

    // Menampilkan detail barang
    public function show(string $id)
    {
        $barang = BarangModel::find($id);

        // BreadCrumb dan Page Title
        $breadcrumb = (object) [
            'title' => 'Detail Barang',
            'list' => ['Home', 'Barang', 'Detail'],
        ];

        $page = (object) [
            'title' => 'Detail Barang',
        ];

        $activeMenu = 'barang';

        return view('barang.show', [
            'breadcrumb' => $breadcrumb, 
            'page' => $page, 
            'barang' => $barang, 
            'activeMenu' => $activeMenu
        ]);
    }

    public function edit(string $id)
    {
        // Ambil data barang berdasarkan ID
        $barang = BarangModel::find($id);

        // Ambil semua kategori untuk ditampilkan di dropdown
        $kategoris = KategoriModel::all();

        // Ambil semua supplier untuk ditampilkan di dropdown (jika diperlukan)
        $suppliers = SupplierModel::all(); 

        // Membuat breadcrumb
        $breadcrumb = (object) [
            'title' => 'Edit Barang',
            'list'  => ['Home', 'Barang', 'Edit']
        ];

        // Membuat data untuk halaman
        $page = (object) [
            'title' => 'Edit Barang'
        ];

        // Menentukan menu yang aktif
        $activeMenu = 'barang';

        // Kirim data ke view
        return view('barang.edit', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'barang' => $barang,
            'kategoris' => $kategoris, // Data kategori untuk dropdown
            'suppliers' => $suppliers, // Data supplier untuk dropdown
            'activeMenu' => $activeMenu
        ]);
    }


    // Menyimpan perubahan data barang
    public function update(Request $request, string $id)
    {
        // Validasi input
        $request->validate([
            'barang_kode' => 'required|string|max:100|unique:m_barang,barang_kode,' . $id . ',barang_id', // Validasi barang_kode
            'barang_nama' => 'required|string|max:255|unique:m_barang,barang_nama,' . $id . ',barang_id', // Validasi barang_nama
            'kategori_id' => 'required|exists:m_kategori,kategori_id', // Validasi kategori_id
            'harga_beli' => 'required|numeric|min:0', // Validasi harga_beli
            'harga_jual' => 'required|numeric|min:0', // Validasi harga_jual
        ]);

        // Update langsung barang berdasarkan ID
        BarangModel::where('barang_id', $id)->update([
            'barang_kode' => $request->barang_kode,  // Update barang_kode
            'barang_nama' => $request->barang_nama,  // Update barang_nama
            'kategori_id' => $request->kategori_id,  // Update kategori_id
            'harga_beli' => $request->harga_beli,    // Update harga_beli
            'harga_jual' => $request->harga_jual,    // Update harga_jual
        ]);

        // Redirect ke halaman daftar barang dengan pesan sukses
        return redirect('/barang')->with('success', 'Data barang berhasil diubah');
    }

    // Menghapus data barang
    public function destroy(string $id)
    {
        $check = BarangModel::find($id);
        if (!$check) {
            return redirect('/barang')->with('error', 'Data barang tidak ditemukan');
        }

        try {
            BarangModel::destroy($id);

            return redirect('/barang')->with('success', 'Data barang berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/barang')->with('error', 'Data barang gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}
