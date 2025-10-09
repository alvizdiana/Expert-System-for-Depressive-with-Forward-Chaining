<?php

namespace App\Controllers;

use App\Models\CheckedQuestionModel;
use App\Models\TestModel;
use App\Models\UserModel;
use \Hermawan\DataTables\DataTable;
use Dompdf\Dompdf;
use Dompdf\Options;

class User extends BaseController
{
    protected $session;
    protected $userModel;
    protected $testModel;

    public function __construct()
    {
        $this->session = session();
        $this->userModel = new UserModel();
        $this->testModel = new TestModel();
    }

    public function index()
    {
        $user = user();
        $userId = $user->id;
        $data = $this->userModel->find($userId);
        return view('user/index', ['data' => $data]);
    }

    // Di dalam controller
    public function lastUrl()
    {
        // Simpan URL saat ini ke session
        $this->session->set('last_url', current_url());
        // Lanjutkan dengan logika lainnya
    }

    public function testResult()
    {
        if ($this->request->isAJAX()) {
            $db = \Config\Database::connect();
            $user = user();
            $userId = $user->id;
            $builder = $db->table('test_result')
                ->select('test_result.id as test_id, test_result.test_date, test_result.jumlah_checked, categories.name as nama_kategori')
                ->join('test_result_categories', 'test_result.id = test_result_categories.test_result_id')
                ->join('categories', 'test_result_categories.category_id = categories.id')
                ->where('test_result.user_id', $userId)
                ->orderBy('test_result.id', 'ASC');;

            return DataTable::of($builder)
                ->add('action', function ($row) {
                    $detailButton = '<button type="button" class="btn btn-custom-green btn-sm" onclick="window.location.href=\'/userTestDetail/' . $row->test_id . '\'">
                <i class="fas fa-list"></i> Detail
            </button>';
                    // Tombol Edit
                    $downPdfButton = '<button type="button" class="btn btn-custom-yellow btn-sm" onclick="window.location.href=\'/downloadPdfUser/' . $row->test_id . '\'">
                <i class="fas fa-download"></i> Download
            </button>';

                    // Menggabungkan kedua tombol
                    return $detailButton . ' ' . $downPdfButton; // Mengembalikan kedua tombol
                }, 'last')
                ->addNumbering()
                ->hide('test_id')
                ->toJson();
        }
    }

    public function userTestDetail($id)
    {
        // Ambil data user
        $user = user();
        $userId = $user->id;
        $userData = $this->userModel->find($userId);

        // Koneksi ke database
        $db = \Config\Database::connect();

        // Ambil data berdasarkan id dari tabel test_result
        // $builder = $db->table('test_result');
        // $builder->where('id', $id);
        $builder = $db->table('test_result')
            ->select('test_result.id, test_result.test_date, test_result.jumlah_checked, test_result.total_pertanyaan, GROUP_CONCAT(categories.name) as kategori')
            ->join('test_result_categories', 'test_result.id = test_result_categories.test_result_id')
            ->join('categories', 'test_result_categories.category_id = categories.id')
            ->where('test_result.id', $id)
            ->groupBy('test_result.id');
        $query = $builder->get();

        // Cek apakah data ditemukan
        if ($query->getNumRows() > 0) {
            $dataTest = $query->getRowArray(); // Ambil satu baris data sebagai array
        } else {
            // Jika tidak ada data, bisa redirect atau menampilkan pesan error
            return redirect()->to('/someErrorPage'); // Ganti dengan rute yang sesuai
        }

        $checkedQuestionModel = new CheckedQuestionModel();
        $selectedQuestions = $checkedQuestionModel->where('user_id', $userId)
            ->where('test_date', $dataTest['test_date'])
            ->findAll();

        // Siapkan data user
        $allQuestions = $this->testModel->findAll();

        $kategori = $dataTest['kategori']; //ambil kategori dari dataTest

        $data = $userData; // Data user

        // Tampilkan view dengan data yang diambil
        return view('user/userTestDetail', [
            'dataTest' => $dataTest,
            'data' => $data,
            'selectedQuestions' => $selectedQuestions,
            'allQuestions' => $allQuestions,
            'kategori' => $kategori
        ]);
    }

    public function downloadPdfUser($id)
    {
        $db = \Config\Database::connect();
        // Ambil data berdasarkan id dari tabel test_result
        $builder = $db->table('test_result')
            ->select('test_result.id as test_id, test_result.test_date, test_result.jumlah_checked, test_result.total_pertanyaan, GROUP_CONCAT(categories.name) as kategori, users.fullname')
            ->join('test_result_categories', 'test_result.id = test_result_categories.test_result_id')
            ->join('categories', 'test_result_categories.category_id = categories.id')
            ->join('users', 'users.id = test_result.user_id')
            ->where('test_result.id', $id)
            ->groupBy('test_result.id');
        $query = $builder->get();

        // Cek apakah data ditemukan
        if ($query->getNumRows() > 0) {
            $dataTest = $query->getRowArray(); // Ambil satu baris data sebagai array
        } else {
            return redirect()->to('/someErrorPage'); // Ganti dengan rute yang sesuai
        }

        // Ambil data gejala yang dipilih
        $checkedQuestionModel = new CheckedQuestionModel();
        $user = user();
        $userId = $user->id;

        $selectedQuestions = $checkedQuestionModel->where('user_id', $userId)
            ->where('test_date', $dataTest['test_date'])
            ->findAll();

        // Load view ke dalam string
        $html = view('user/pdf_template', [
            'dataTest' => $dataTest,
            'selectedQuestions' => $selectedQuestions,
            'allQuestions' => $this->testModel->findAll(), // Ambil semua pertanyaan
            'kategori' => $dataTest['kategori'], // Sertakan kategori dalam data yang dikirim ke view
            'fullname' => $dataTest['fullname']
        ]);

        // Inisialisasi Dompdf
        $options = new Options();
        $options->set('defaultFont', 'Courier');
        $dompdf = new Dompdf($options);

        // Load HTML ke Dompdf
        $dompdf->loadHtml($html);

        // Set ukuran dan orientasi kertas
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF
        $dompdf->render();

        // Output PDF ke browser
        $dompdf->stream('hasil_test.pdf', ['Attachment' => true]);
    }
}
