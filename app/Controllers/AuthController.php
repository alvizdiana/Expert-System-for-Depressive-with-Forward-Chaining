<?php

namespace App\Controllers;

use Myth\Auth\Models\UserModel;

class AuthController extends BaseController
{
    public function login()
    {
        // Tampilkan form login
        return view('Myth\Auth\Src\Views\login'); // Ganti dengan path view yang sesuai
    }

    public function doLogin()
    {
        // Ambil kredensial dari request
        $credentials = [
            'email' => $this->request->getPost('email', true),
            'password' => $this->request->getPost('password', true)
        ];

        // Gunakan service authentication
        $auth = service('authentication');

        // Coba login
        if ($auth->attempt($credentials)) {
            // Login berhasil, ambil user_id dan simpan di sesi
            $userId = $auth->id(); // Mengambil ID pengguna
            session()->set('user_id', $userId); // Menyimpan user_id di sesi

            // Redirect ke halaman dashboard atau halaman lain setelah login
            return redirect()->to('/dashboard');
        } else {
            // Login gagal, kembalikan ke form login dengan pesan kesalahan
            return redirect()->back()->withInput()->with('error', 'Invalid login credentials');
        }
    }

    public function logout()
    {
        // Hapus sesi
        session()->remove('user_id'); // Menghapus user_id dari sesi
        $auth = service('authentication');
        $auth->logout(); // Logout pengguna

        // Redirect ke halaman login
        return redirect()->to('/login');
    }
}
