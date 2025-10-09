<?php

namespace App\Controllers;

use App\Models\TestModel;
use \Hermawan\DataTables\DataTable;
use App\Models\UserModel;

class Pengetahuan extends BaseController
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
        return view('admin/pengetahuan', ['data' => $data]);
    }

    public function soalList()
    {
        if ($this->request->isAJAX()) {
            $db = \Config\Database::connect();
            $builder = $db->table('pertanyaan')->select('id, soal');

            return DataTable::of($builder)
                ->add('action', function ($row) {
                    // Tombol Edit (misalnya)
                    $editButton = '<button type="button" class="btn btn-custom-yellow btn-sm" onclick="openEditModal(' . $row->id . ', \'' . addslashes($row->soal) . '\')">
                            <i class="fas fa-edit"></i> Edit
                        </button>';

                    // Tombol Delete
                    $deleteButton = '<button type="button" class="btn btn-danger btn-sm" onclick="deleteSoal(' . $row->id . ')">
                            <i class="fas fa-trash"></i> Delete
                        </button>';

                    // Menggabungkan kedua tombol
                    return  $editButton . ' ' . $deleteButton; // Mengembalikan kedua tombol
                }, 'last')
                ->addNumbering('no')
                ->hide('id')
                ->toJson();
        }
    }

    public function addSoal()
    {
        if ($this->request->getMethod() === 'post') {
            $soal = $this->request->getPost('soal');

            // Koneksi ke database
            $db = \Config\Database::connect();
            $builder = $db->table('pertanyaan');

            // Menyimpan data ke database
            $data = [
                'soal' => $soal,
            ];

            $builder->insert($data);

            // Mengembalikan respons
            return $this->response->setJSON(['status' => 'success']);
        }

        return $this->response->setJSON(['status' => 'error']);
    }

    public function editSoal()
    {
        if ($this->request->getMethod() === 'post') {
            $id = $this->request->getPost('id');
            $soal = $this->request->getPost('soal');

            // Koneksi ke database
            $db = \Config\Database::connect();
            $builder = $db->table('pertanyaan');

            // Menyimpan data ke database
            $data = [
                'soal' => $soal,
            ];

            $builder->where('id', $id);
            $builder->update($data);

            // Mengembalikan respons
            return $this->response->setJSON(['status' => 'success']);
        }

        return $this->response->setJSON(['status' => 'error']);
    }

    public function deleteSoal($id)
    {
        // Koneksi ke database
        $db = \Config\Database::connect();
        $builder = $db->table('pertanyaan');

        // Menghapus data dari database
        $builder->where('id', $id);
        $builder->delete();

        // Mengembalikan respons
        return $this->response->setJSON(['status' => 'success']);
    }
}
