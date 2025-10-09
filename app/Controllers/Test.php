<?php

namespace App\Controllers;

use App\Models\CheckedQuestionModel;
use App\Models\UserModel;
use App\Models\TestModel;
use App\Models\TestResultModel;
use Dompdf\Dompdf;
use Dompdf\Options;

class Test extends BaseController
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
        // cek udah login blm
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }

        // Ambil data dari model
        $pertanyaan = $this->testModel->orderBy('RAND()')->findAll(); // Kirim data ke view 
        // $pertanyaan = $this->testModel->findAll(); // Kirim data ke view 
        $data = [
            'pertanyaan' => $pertanyaan
        ];

        return view('test/index', $data);
    }

    public function submit()
    {
        // Set zona waktu ke waktu Indonesia
        date_default_timezone_set('Asia/Jakarta');

        $checkboxes = $this->request->getPost('checkboxes') ?? []; // ambil data checkbox yang di-check
        // pastiin user udah milih
        // if (empty($checkboxes)) {
        //     return redirect()->to('/test')->with('error', 'Pastikan anda sudah meceklis minimal 2.');
        // }

        $totalPertanyaan = $this->testModel->countAll(); // hitung total pertanyaan
        $jumlahChecked = count($checkboxes); // hitung jumlah checkbox yang di-check

        // inisiasi kategori
        $kategoriIds = [];

        // kriteria penentuan kategori
        $gejalaUmum = array_intersect($checkboxes, range(1, 8)); // gejala 1-8
        $gejalaTambahan = array_intersect($checkboxes, range(9, 11)); // gejala 9-11
        $gejalaBerat = array_intersect($checkboxes, range(12, 13)); // gejala 12-13

        // Logika pengkategorian
        $countGejalaUmum = count($gejalaUmum);
        $countGejalaTambahan = count($gejalaTambahan);

        // kategori depresi berat
        if ($countGejalaUmum >= 4 && $countGejalaTambahan === 3) {
            $kategoriIds[] = 3;
        }
        // kategori depresi sedang
        else if ($countGejalaUmum >= 3 && $countGejalaTambahan >= 2) {
            $kategoriIds[] = 2;
        }
        // kategori depresi ringan
        else if ($countGejalaUmum >= 2 && $countGejalaTambahan >= 2) {
            $kategoriIds[] = 1;
        }
        // kategori terindikasi gangguan depresif
        else if ($countGejalaUmum >= 1) {
            $kategoriIds[] = 4;
        }
        // kategori baik-baik saja
        else {
            $kategoriIds[] = 5; // baik-baik saja
        }

        $session = session();
        if ($session->get('logged_in')) {
            // Menggunakan helper user() untuk mengambil informasi pengguna yang sedang login
            $user = user();
            $userId = $user->id; // Ambil user_id dari objek user
        } else {
            return redirect()->to('/login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        // simpan data ke db
        $dataToSave = [
            'user_id' => $userId,
            'test_date' => date('Y-m-d H:i:s'),
            'jumlah_checked' => $jumlahChecked,
            'total_pertanyaan' => $totalPertanyaan,
        ];
        $this->testResultModel->save($dataToSave);

        // ambil ID dari hasil yang barusan disimpan
        $testResultId = $this->testResultModel->insertID();
        $allQuestions = $this->testModel->findAll();

        // Simpan kategori ke tabel pivot
        $db = \Config\Database::connect();
        foreach ($kategoriIds as $categoryId) {
            $db->table('test_result_categories')->insert([
                'test_result_id' => $testResultId,
                'category_id' => $categoryId,
            ]);
        }

        // Ambil solusi penanganan berdasarkan kategori
        $penanganan = [];
        foreach ($kategoriIds as $categoryId) {
            $solusi = $this->testResultModel->getSolusiByKelas($categoryId); // Ambil solusi berdasarkan ID kategori
            if (!empty($solusi)) {
                $penanganan = array_merge($penanganan, $solusi); // Tambahkan solusi ke array penanganan
            }
        }

        // Pastikan penanganan adalah array
        if (empty($penanganan)) {
            $penanganan = []; // Atau Anda bisa mengatur pesan default jika perlu
        }

        // simpan dan ambil gejala yang dipilih
        $checkedQuestionModel = new CheckedQuestionModel();
        $testDate = $dataToSave['test_date'];
        foreach ($checkboxes as $questionId) {
            $dataChecked = [
                'user_id' => $userId,
                'question_id' => $questionId,
                'test_date' => $testDate,
                'test_id' => $testResultId,
            ];
            $checkedQuestionModel->save($dataChecked);
        }

        // Ambil gejala yang dipilih untuk ditampilkan di view
        $selectedQuestions = $checkedQuestionModel->getSelectedQuestions($userId, $testDate);

        // Ambil nama kategori berdasarkan ID kategori
        $kategoriNames = [];
        foreach ($kategoriIds as $categoryId) {
            $category = $db->table('categories')->where('id', $categoryId)->get()->getRow();
            if ($category) {
                $kategoriNames[] = $category->name; // Ambil nama kategori
            }
        }

        // Kirim data ke view hasil
        $data = [
            'jumlahChecked' => $jumlahChecked,
            'totalPertanyaan' => $totalPertanyaan,
            'kategori' => $kategoriNames, // Kirim nama kategori ke view
            'penanganan' => $penanganan,
            'selectedQuestions' => $selectedQuestions,
            'allQuestions' => $allQuestions
        ];

        return view('test/hasil', $data);
    }

    public function downloadPdf($id)
    {
        // Ambil data berdasarkan id dari tabel test_result
        $builder = $this->testResultModel->select('test_result.id as test_id, test_date, jumlah_checked, total_pertanyaan, skor')
            ->join('test_result', 'test_result.id = test_result.id')
            ->where('test_result.id', $id);
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

        // Ambil semua pertanyaan
        $allQuestions = $this->testModel->findAll();

        // Load view ke dalam string
        $html = view('test/pdf_template', [
            'dataTest' => $dataTest,
            'selectedQuestions' => $selectedQuestions,
            'allQuestions' => $allQuestions
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
