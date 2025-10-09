<?php

namespace App\Controllers;

use App\Models\UsersModel;
use \Hermawan\DataTables\DataTable;
use App\Models\UserModel;

class Users extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $user = user();
        $userId = $user->id;
        $data = $this->userModel->find($userId);
        return view('admin/users', ['data' => $data]);
    }

    public function usersList()
    {
        if ($this->request->isAJAX()) {
            $db = \Config\Database::connect();
            $builder = $db->table('users')
                ->select('users.id as users_id, email, fullname, birthday, active, auth_groups.name as group_name')
                ->join('auth_groups_users', 'users.id = auth_groups_users.user_id')
                ->join('auth_groups', 'auth_groups_users.group_id = auth_groups.id');

            return DataTable::of($builder)
                ->addNumbering('no')
                ->add('action', function ($row) {
                    // Tombol Detail
                    $detailButton = '<button type="button" class="btn btn-custom-green btn-sm" onclick="window.location.href=\'/usersDetail/' . $row->users_id . '\'">
                        <i class="fas fa-list"></i> Detail
                    </button>';
                    // Tombol Edit
                    $editButton = '<button type="button" class="btn btn-custom-yellow btn-sm" onclick="window.location.href=\'/editUser/' . $row->users_id . '\'">
                        <i class="fas fa-edit"></i> Edit
                    </button>';
                    // Tombol Detail
                    $deleteButton = '<button type="button" class="btn btn-danger btn-sm" onclick="deleteUser(' . $row->users_id . ')">
                        <i class="fas fa-trash"></i> Delete
                    </button>';

                    // Menggabungkan kedua tombol
                    return $detailButton . ' ' . $editButton . ' ' . $deleteButton; // Mengembalikan kedua tombol
                }, 'last')
                ->hide('users_id')
                ->toJson(true);
        }
    }

    public function usersDetail($id)
    {
        // $db = \Config\Database::connect();
        // $builder = $db->table('users')
        //     ->select('users.id as users_id, email, username, fullname, birthday, active, auth_groups.name as group_name')
        //     ->join('auth_groups_users', 'users.id = auth_groups_users.user_id')
        //     ->join('auth_groups', 'auth_groups_users.group_id = auth_groups.id')
        //     ->where('users.id', $id);

        // $query = $builder->get();

        // if ($query->getNumRows() > 0) {
        //     $data['userDetail'] = $query->getRow(); // Ambil satu baris data
        //     return view('admin/usersDetail', $data); // Tampilkan view detail pengguna
        // } else {
        //     return redirect()->to('/someErrorPage'); // Ganti dengan rute yang sesuai jika data tidak ditemukan
        // }

        $user = user();
        $userId = $user->id;
        $userData = $this->userModel->find($userId);

        $db = \Config\Database::connect();
        $builder = $db->table('users')
            ->select('users.id as users_id, email, username, fullname, birthday, active, auth_groups.name as group_name')
            ->join('auth_groups_users', 'users.id = auth_groups_users.user_id')
            ->join('auth_groups', 'auth_groups_users.group_id = auth_groups.id')
            ->where('users.id', $id);

        $query = $builder->get();

        if ($query->getNumRows() > 0) {
            $userDetail = $query->getRowArray(); // Ambil satu baris data dalam format array
        } else {
            return redirect()->to('/someErrorPage'); // Ganti dengan rute yang sesuai jika data tidak ditemukan
        }

        $data = $userData;

        return view('admin/usersDetail', [
            'userDetail' => $userDetail,
            'data' => $data
        ]); // Tampilkan view detail pengguna
    }

    public function editUser($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users')
            ->select('users.id as users_id, email, username, fullname, birthday, active, auth_groups.name as group_name')
            ->join('auth_groups_users', 'users.id = auth_groups_users.user_id')
            ->join('auth_groups', 'auth_groups_users.group_id = auth_groups.id')
            ->where('users.id', $id);

        $query = $builder->get();

        if ($query->getNumRows() > 0) {
            $data['userDetail'] = $query->getRow(); // Ambil satu baris data
            return view('admin/editUser', $data); // Tampilkan view form edit pengguna
        } else {
            return redirect()->to('/someErrorPage'); // Ganti dengan rute yang sesuai jika data tidak ditemukan
        }
    }

    public function updateUser($id)
    {
        if ($this->request->getMethod() === 'post') {
            $db = \Config\Database::connect();
            $builder = $db->table('users');

            // Ambil data dari form
            $data = [
                'email' => $this->request->getPost('email'),
                'username' => $this->request->getPost('username'),
                'fullname' => $this->request->getPost('fullname'),
                'birthday' => $this->request->getPost('birthday'),
                'active' => $this->request->getPost('active'),
            ];

            // Update data pengguna
            $builder->where('id', $id);
            $builder->update($data);

            return redirect()->to('/users')->with('success', 'User  updated successfully.');
        }

        return redirect()->to('/someErrorPage'); // Redirect jika bukan POST
    }

    public function deleteUser($id)
    {
        // Koneksi ke database
        $db = \Config\Database::connect();
        $builder = $db->table('users');

        // Menghapus data dari database
        $builder->where('id', $id);
        $builder->delete();

        // Mengembalikan respons
        return $this->response->setJSON(['status' => 'success']);
    }
}
