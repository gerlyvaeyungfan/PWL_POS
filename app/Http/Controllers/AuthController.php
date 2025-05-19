<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\LevelModel;




class AuthController extends Controller
{
    public function login()
    {
        if (Auth::check()) { // jika sudah login, maka redirect ke halaman home
            return redirect('/');
        }
        return view('auth.login');
    }

    public function postlogin(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $credentials = $request->only('username', 'password');

            if (Auth::attempt($credentials)) {
                return response()->json([
                    'status' => true,
                    'message' => 'Login Berhasil',
                    'redirect' => url('/')
                ]);
            }

            return response()->json([
                'status' => false,
                'message' => 'Login Gagal'
            ]);
        }
        
        return redirect('login');
    }

//----------------------------------------------------------------------------------------------------------
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }

//--------------------------------------------------------------------------------------------------------------------
    public function showRegisterForm()
    {
        $level = LevelModel::all(); // ambil semua data level dari DB
        return view('auth.register', compact('level'));
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'level_id' => 'required|exists:m_level,level_id',
            'username' => 'required|string|min:3|max:20|unique:m_user,username',
            'nama' => 'required|string|max:100',
            'password' => 'required|string|min:6|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal!',
                'msgField' => $validator->errors()
            ]);
        }

        $user = new UserModel();
        $user->level_id = $request->level_id;
        $user->username = $request->username;
        $user->nama = $request->nama;
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'Registrasi berhasil! Silahkan Login.',
            'redirect' => url('/login')
        ]);
    }
}