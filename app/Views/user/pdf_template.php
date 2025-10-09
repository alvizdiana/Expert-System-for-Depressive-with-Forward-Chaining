<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Test</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1,
        h2,
        h3 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1>Detail Test</h1>
    <p>Nama: <b><?= esc($dataTest['fullname']); ?></b></p>
    <p>Tanggal: <b><?= esc($dataTest['test_date']); ?></b></p>
    <p>Jumlah checkbox yang di-check: <?= esc($dataTest['jumlah_checked']); ?></p>
    <p>Total pertanyaan: <?= esc($dataTest['total_pertanyaan']); ?></p>
    <p>Hasil: <strong><?= esc($kategori); ?></strong></p>

    <h3>Gejala yang Dipilih:</h3>
    <table>
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Gejala Dipilih</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($selectedQuestions)): ?>
                <?php $no = 1; ?>
                <?php foreach ($selectedQuestions as $question): ?>
                    <tr>
                        <td><?= esc($no++); ?></td>
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
                    <td colspan="1" class="text-center">Tidak ada gejala yang dipilih.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>

</html>