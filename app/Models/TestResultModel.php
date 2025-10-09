<?php

namespace App\Models;

use CodeIgniter\Model;

class TestResultModel extends Model
{
    protected $table = 'test_result';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'test_date', 'jumlah_checked', 'total_pertanyaan', 'kategori'];

    // Metode untuk mengambil penanganan penanganan berdasarkan kelas
    // public function getSolusiByKelas($kategori)
    // {
    //     // Mengambil solusi penanganan dari tabel 'penanganan'
    //     $builder = $this->db->table('saran_penanganan');
    //     $builder->select('penanganan');
    //     $builder->where('kategori', $kategori);
    //     $query = $builder->get();

    //     // Memeriksa dan mengembalikan hasil
    //     if ($query->getNumRows() > 0) {
    //         return $query->getResultArray(); // Mengembalikan penanganan
    //     } else {
    //         return []; // Jika tidak ada penanganan ditemukan
    //     }
    // }

    public function getSolusiByKelas($categoriId)
    {
        // Mengambil solusi penanganan dari tabel 'saran_penanganan'
        $builder = $this->db->table('saran_penanganan');
        $builder->select('penanganan');
        $builder->where('kategori', $categoriId); // Pastikan ini sesuai dengan kolom di tabel
        $query = $builder->get();

        // Memeriksa dan mengembalikan hasil
        if ($query->getNumRows() > 0) {
            // Mengembalikan hasil sebagai array dengan kunci 'penanganan'
            return array_map(function ($row) {
                return ['penanganan' => $row['penanganan']];
            }, $query->getResultArray());
        } else {
            return []; // Jika tidak ada penanganan ditemukan
        }
    }
}
