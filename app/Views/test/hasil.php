<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="hasil-container">
    <h1>Hasil</h1>
    <h3>Pertanyaan yang dipilih:</h3>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Pertanyaan</th>
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
                            echo !empty($soal) ? reset($soal)['soal'] : 'Pertanyaan tidak ditemukan';
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
    <p>Anda memilih sebanyak <b><?= $jumlahChecked; ?></b> gejala dari total <b><?= $totalPertanyaan; ?></b> pertanyaan</p>
    <h5>Hasil skrining yang anda dapatkan adalah: </h5>
    <h4><b><?= esc(implode(", ", $kategori)); ?></b></h4>

    <h3>Solusi Penanganan:</h3>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Solusi Penanganan</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($penanganan)): ?>
                <?php foreach ($penanganan as $index => $solusi): ?>
                    <tr>
                        <td><?= $index + 1; ?></td> <!-- Menampilkan nomor urut -->
                        <td>
                            <?php if (is_array($solusi)): ?>
                                <!-- Jika solusi adalah array, ambil elemen yang diinginkan -->
                                <?php foreach ($solusi as $item): ?>
                                    <?= htmlspecialchars($item); ?><br> <!-- Menampilkan item dengan pemisah baris -->
                                <?php endforeach; ?>
                            <?php else: ?>
                                <?= htmlspecialchars($solusi); ?> <!-- Jika solusi adalah string -->
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="2">Tidak ada solusi yang tersedia.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Tombol WhatsApp -->
    <div class="wa-button">
        <a href="https://wa.me/6288806848668" target="_blank" class="btn btn-custom-green">
            WhatsApp
        </a>
        <a href="/test" class="btn btn-custom-yellow">
            Ulang Tes
        </a>
    </div>
    <p>(*) Hubungi kami melalui WhatsApp dengan klik tombol "WhatsApp" diatas untuk menentukan rencana tindak lanjut</p>
</div>

<?= $this->endSection(); ?>