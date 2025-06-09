<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\LevelModel;

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
        /** @var \App\Models\UserModel $user */
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
            $foto = $request->file('foto');

            // Hapus foto lama
            if ($user->foto) {
                $fotoLama = basename($user->foto);
                $pathLama = storage_path('app/public/posts/' . $fotoLama);
                if (file_exists($pathLama)) {
                    @unlink($pathLama);
                }
            }

            // Simpan foto baru ke storage/app/public/posts dengan nama hash
            $foto->storeAs('public/posts', $foto->hashName());

            // Simpan hashName ke DB
            $user->foto = $foto->hashName();
        }

        $user->save();

        return response()->json([
            'status'  => true,
            'message' => 'Profil berhasil diperbarui'
        ]);
    }


}
