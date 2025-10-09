<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\TestModel;
use App\Models\TestResultModel;
use App\Models\UserModel;
use \Hermawan\DataTables\DataTable;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Dompdf\Dompdf;
use Dompdf\Options;

class Admin extends BaseController
{
    protected $testModel;
    protected $testResultModel;
    protected $userModel;

    public function __construct()
    {
        // inisiasi
        $this->testModel = new TestModel();
        $this->testResultModel = new TestResultModel();
        $this->userModel = new UserModel();
        helper('auth');
    }

    public function index()
    {
        $user = user();
        $userId = $user->id;
        $data = $this->userModel->find($userId);

        // Ambil jumlah user yang terdaftar dari tabel 'users'
        $totalUsers = $this->userModel->countAll();

        // Ambil jumlah tes yang terdata dari tabel 'test_result'
        $totalTests = $this->testResultModel->countAll();

        // Kirim data ke view
        return view('admin/index', [
            'data' => $data,
            'totalUsers' => $totalUsers,
            'totalTests' => $totalTests
        ]);
    }

    public function testList()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('test_result')
            ->select('test_result.id as test_id, test_result.user_id, test_result.test_date, test_result.jumlah_checked, GROUP_CONCAT(categories.name) as kategori, users.fullname')
            ->join('users', 'users.id = test_result.user_id', 'left')
            ->join('test_result_categories', 'test_result.id = test_result_categories.test_result_id', 'left')
            ->join('categories', 'test_result_categories.category_id = categories.id', 'left')
            ->groupBy('test_result.id')
            ->orderBy('test_result.id', 'ASC');

        return DataTable::of($builder)
            ->add('action', function ($row) {
                // Tombol Detail
                $detailButton = '<button type="button" class="btn btn-custom-green btn-sm" onclick="window.location.href=\'/detailTest/' . $row->test_id . '\'">
                <i class="fas fa-list"></i> Detail
            </button>';
                // Tombol Edit
                $downPdfButton = '<button type="button" class="btn btn-custom-yellow btn-sm" onclick="window.location.href=\'/downloadPdf/' . $row->test_id . '\'">
                <i class="fas fa-download"></i> Download
            </button>';
                // Tombol Delete
                $deleteButton = '<button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(' . $row->test_id . ')">
                <i class="fas fa-trash"></i> Delete
            </button>';

                // Menggabungkan kedua tombol
                return $detailButton . ' ' . $downPdfButton . ' ' . $deleteButton; // Mengembalikan kedua tombol
            }, 'last')
            ->addNumbering('no')
            ->hide('test_id')
            ->hide('test_result.user_id')
            ->toJson(true);
    }

    public function deleteTest($id)
    {
        $db = \Config\Database::connect();

        // Hapus data terkait di tabel checked_question
        $builderCheckedQuestion = $db->table('checked_question');
        $builderCheckedQuestion->delete(['test_id' => $id]);

        // Hapus data dari tabel test_result
        $builderTestResult = $db->table('test_result');
        if ($builderTestResult->delete(['id' => $id])) {
            return redirect()->to('/dbadmin')->with('success', 'Data berhasil dihapus.');
        } else {
            return redirect()->to('/dbadmin')->with('error', 'Gagal menghapus data.');
        }
    }

    public function detailTest($id)
    {
        // Ambil data user
        $user = user();
        $userId = $user->id;
        $userData = $this->userModel->find($userId);

        // Koneksi ke database
        $db = \Config\Database::connect();

        // Ambil data berdasarkan id
        $builder = $db->table('test_result')
            ->select('test_result.id as test_id, test_result.test_date, test_result.jumlah_checked, test_result.total_pertanyaan, GROUP_CONCAT(categories.name) as kategori, users.fullname')
            ->join('users', 'users.id = test_result.user_id')
            ->join('test_result_categories', 'test_result.id = test_result_categories.test_result_id')
            ->join('categories', 'test_result_categories.category_id = categories.id')
            ->where('test_result.id', $id)
            ->groupBy('test_result.id');
        $query = $builder->get();

        // Cek apakah data ditemukan
        if ($query->getNumRows() > 0) {
            $dataTest = $query->getRowArray();
        } else {
            // Jika tidak ada data, bisa redirect atau menampilkan pesan error
            return redirect()->to('/someErrorPage'); // Ganti dengan rute yang sesuai
        }

        // Ambil gejala (pertanyaan) yang dipilih berdasarkan test_id dan test_date
        $testId = $dataTest['test_id']; // Ambil test_id dari dataTest
        $testDate = $dataTest['test_date'];

        $builderGejala = $db->table('checked_question')
            ->select('checked_question.question_id, pertanyaan.soal')
            ->join('pertanyaan', 'pertanyaan.id = checked_question.question_id')
            ->where('checked_question.test_id', $testId) // Menggunakan test_id
            ->where('checked_question.test_date', $testDate);
        $gejalaQuery = $builderGejala->get();

        // Ambil data gejala
        $gejalaData = $gejalaQuery->getResultArray();
        $kategori = $dataTest['kategori']; //ambil kategori dari dataTest

        // Tampilkan view dengan data yang diambil
        return view('admin/detailTest', [
            'dataTest' => $dataTest,
            'data' => $userData,
            'gejalaData' => $gejalaData, // Tambahkan data gejala ke view
            'kategori' => $kategori
        ]);
    }

    public function downloadExcel()
    {
        // Koneksi ke database
        $db = \Config\Database::connect();

        // Ambil data dari tabel test_result dengan join
        $builder = $db->table('test_result')
            ->select('test_result.id as test_id, test_result.user_id, test_result.test_date, test_result.jumlah_checked, GROUP_CONCAT(categories.name) as kategori, users.fullname')
            ->join('users', 'users.id = test_result.user_id', 'left')
            ->join('test_result_categories', 'test_result.id = test_result_categories.test_result_id', 'left')
            ->join('categories', 'test_result_categories.category_id = categories.id', 'left')
            ->groupBy('test_result.id'); // Mengelompokkan berdasarkan id test_result

        $data = $builder->get()->getResultArray(); // Ambil data sebagai array

        // Buat spreadsheet baru
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set header kolom
        $sheet->setCellValue('A1', 'ID Test');
        $sheet->setCellValue('B1', 'User ');
        $sheet->setCellValue('C1', 'Tanggal Test');
        $sheet->setCellValue('D1', 'Total Gejala');
        $sheet->setCellValue('E1', 'Kategori');

        // Isi data
        $row = 2; // Mulai dari baris kedua
        foreach ($data as $test) {
            $username = $test['fullname'] ?? 'Unknown'; // Ganti dengan nama pengguna

            $sheet->setCellValue('A' . $row, $test['test_id']);
            $sheet->setCellValue('B' . $row, $username);
            $sheet->setCellValue('C' . $row, $test['test_date']);
            $sheet->setCellValue('D' . $row, $test['jumlah_checked']);
            $sheet->setCellValue('E' . $row, $test['kategori']);
            $row++;
        }

        // Buat writer dan simpan file
        $writer = new Xlsx($spreadsheet);
        $filename = 'test_results_' . date('Y-m-d') . '.xlsx';

        // Set header untuk download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // Tulis file ke output
        $writer->save('php://output');
        exit;
    }

    public function downloadPdf($id)
    {
        // Koneksi ke database
        $db = \Config\Database::connect();

        // Ambil data berdasarkan id dari tabel test_result dengan join
        $builder = $db->table('test_result')
            ->select('test_result.id as test_id, test_result.test_date, test_result.jumlah_checked, test_result.total_pertanyaan, GROUP_CONCAT(categories.name) as kategori, users.fullname')
            ->join('users', 'users.id = test_result.user_id', 'left')
            ->join('test_result_categories', 'test_result.id = test_result_categories.test_result_id', 'left')
            ->join('categories', 'test_result_categories.category_id = categories.id', 'left')
            ->where('test_result.id', $id)
            ->groupBy('test_result.id'); // Mengelompokkan berdasarkan id test_result

        // Ambil hasil query
        $query = $builder->get();

        // Cek apakah data ditemukan
        if ($query->getNumRows() > 0) {
            $dataTest = $query->getRowArray();
        } else {
            return redirect()->to('/someErrorPage'); // Ganti dengan rute yang sesuai
        }

        // Ambil gejala (pertanyaan) yang dipilih berdasarkan test_id dan test_date
        $testId = $dataTest['test_id'];
        $testDate = $dataTest['test_date'];

        $builderGejala = $db->table('checked_question')
            ->select('checked_question.question_id, pertanyaan.soal')
            ->join('pertanyaan', 'pertanyaan.id = checked_question.question_id')
            ->where('checked_question.test_id', $testId)
            ->where('checked_question.test_date', $testDate);
        $gejalaQuery = $builderGejala->get();

        // Ambil data gejala
        $gejalaData = $gejalaQuery->getResultArray();

        // Load view ke dalam string
        $html = view('admin/pdfTemplate', [
            'dataTest' => $dataTest,
            'gejalaData' => $gejalaData,
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
