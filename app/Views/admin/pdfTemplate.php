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

        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>
    <h1>Hasil Test</h1>
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
            <?php if (!empty($gejalaData)): ?>
                <?php $no = 1; ?>
                <?php foreach ($gejalaData as $gejala): ?>
                    <tr>
                        <td><?= esc($no++); ?></td>
                        <td><?= esc($gejala['soal']); ?></td>
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