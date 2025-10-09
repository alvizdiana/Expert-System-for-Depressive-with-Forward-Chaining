<?= $this->extend('layout/templatedb'); ?>

<?= $this->section('contentdbuser'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Hasil Test</h1>
    </div>

    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl col-lg">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <a href="/dbuser"><i class="fas fa-arrow-left"></i></a>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="hasil-container">
                        <h1>Detail Test</h1>
                        <p>Test dilakukan pada: <?= $dataTest['test_date']; ?></p>
                        <p>Jumlah checkbox yang di-check: <?= $dataTest['jumlah_checked']; ?></p>
                        <p>Total pertanyaan: <?= $dataTest['total_pertanyaan']; ?></p>
                        <p>Dengan hasil:</p>
                        <h4><?= esc($kategori); ?></h4>
                        <h3>Gejala yang Dipilih:</h3>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Gejala Dipilih</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($selectedQuestions)): ?>
                                    <?php
                                    $no = 1;
                                    foreach ($selectedQuestions as $question): ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td>
                                                <?php
                                                // Cari soal berdasarkan question_id
                                                $soal = array_filter($allQuestions, function ($q) use ($question) {
                                                    return $q['id'] == $question['question_id'];
                                                });
                                                // Ambil soal dari hasil filter
                                                echo !empty($soal) ? reset($soal)['soal'] : 'Soal tidak ditemukan';
                                                ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="2">Tidak ada gejala yang dipilih.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
<!-- /.container-fluid -->

<?= $this->endSection(); ?>