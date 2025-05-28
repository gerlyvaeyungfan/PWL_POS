<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\LevelModel;
use App\Models\User;  // pastikan model User sudah dibuat dan namespace sesuai

class ProfilController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Profil Pengguna',
            'list' => ['Home', 'Profil'],
        ];

        $page = (object) [
            'title' => 'Informasi profil pengguna yang sedang login',
        ];

        $activeMenu = 'profil';

        $user = Auth::user();

        return view('profil.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'user' => $user
        ]);
    }

    public function edit()
    {
        $user = Auth::user();
        $level = LevelModel::select('level_id', 'level_nama')->get();

        return view('profil.edit', compact('user', 'level'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'username' => 'required|min:3|max:20|unique:m_user,username,' . $user->user_id . ',user_id',
            'nama'     => 'required|min:3|max:100',
            'password' => 'nullable|min:6|max:20',
            'foto'     => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user->username = $request->username;
        $user->nama = $request->nama;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('foto')) {
            $this->hapusFotoLama($user->foto);

            $user->foto = $this->uploadFotoBaru($request->file('foto'));
        }

        $user->save();
        return response()->json([
            'status' => true,
            'message' => 'Profil berhasil diperbarui'
        ]);
    }

    private function hapusFotoLama($fotoPath)
    {
        if ($fotoPath && file_exists(public_path($fotoPath))) {
            unlink(public_path($fotoPath));
        }
    }

    private function uploadFotoBaru($file)
    {
        $filename = date('YmdHis') . '_' . $file->getClientOriginalName();
        $file->move(public_path('user_foto'), $filename);
        return 'user_foto/' . $filename;
    }
}
