<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Myth\Auth\Models\UserModel;

class UserProfile extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        // Pastikan pengguna sudah login
        if (!session()->get('logged_in')) {
            return redirect()->to('/login'); // Redirect ke halaman login jika belum login
        }

        // Ambil data pengguna dari session
        $user = user();
        $userId = $user->id;

        // Ambil data pengguna dari database
        $userModel = new UserModel();
        $data = $userModel->asArray()->find($userId);

        // Tampilkan data profil pengguna
        return view('user/userProfile', ['data' => $data]);
    }

    public function updateProfile()
    {
        if ($this->request->getMethod() === 'post') {
            $userId = $this->request->getPost('id');
            $data = [
                'username' => $this->request->getPost('username'),
                'email' => $this->request->getPost('email'),
                'fullname' => $this->request->getPost('fullname'),
                'birthday' => $this->request->getPost('birthday'),
            ];

            // Koneksi ke database
            $db = \Config\Database::connect();
            $builder = $db->table('users'); // Ganti 'users' dengan nama tabel yang sesuai

            // Menyimpan data ke database
            $builder->where('id', $userId);
            $updated = $builder->update($data);

            // Mengembalikan respons
            return redirect()->to('/userProfile')->with('success', 'Account updated successfully.');
        }
    }

    public function deleteAccount()
    {
        $userId = $this->request->getPost('id');

        // Hapus akun pengguna dari database
        $this->userModel->delete($userId);

        // Logout pengguna setelah menghapus akun
        session()->destroy();

        return redirect()->to('/')->with('success', 'Account deleted successfully.');
    }
}
