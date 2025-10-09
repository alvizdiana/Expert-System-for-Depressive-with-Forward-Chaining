<?= $this->extend('layout/templateadmin'); ?>

<?= $this->section('contentdbadmin'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Hasil</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
    </div>

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl col-lg">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <a href="/dbadmin"><i class="fas fa-arrow-left"></i></a>

                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="hasil-container">
                        <h1>Hasil Test</h1>
                        <p>Test dilakukan oleh: <b><?= $dataTest['fullname']; ?></b> pada: <?= $dataTest['test_date']; ?></p>
                        <p>Jumlah checkbox yang di-check: <?= $dataTest['jumlah_checked']; ?></p>
                        <p>Total pertanyaan: <?= $dataTest['total_pertanyaan']; ?></p>
                        <p>Dengan hasil:</p>
                        <h4><?= esc($kategori); ?></h4>
                        <h5 style="margin: 25px 0px 10px 0px;">Pertanyaan yang dipilih:</h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Pertanyaan</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tbody>
                                <?php if (!empty($gejalaData)): ?>
                                    <?php
                                    $no = 1;
                                    foreach ($gejalaData as $gejala): ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?= esc($gejala['soal']); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="1" class="text-center">Tidak ada gejala yang dipilih.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
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