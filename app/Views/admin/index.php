<?= $this->extend('layout/templateadmin'); ?>

<?= $this->section('contentdbadmin'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 heading-text">Admin Dashboard</h1>
    </div>

    <!-- Content Row -->

    <div class="row">

        <!-- Earnings (Monthly) Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-green shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Users</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totalUsers; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Annual) Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-green shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Test</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totalTests; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-folder-open fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>
    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl col-lg">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-dark">Recent Test</h6>
                    <a href="/downloadExcel" class="d-none d-sm-inline-block btn btn-sm btn-custom-green shadow-sm"><i
                            class="fas fa-download fa-sm text-white-50"></i> Download as Excel</a>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <table class="table table-sm table-bordered" id="usertest" style="width: 100%;">
                        <thead>
                            <tr>
                                <th style="width: 5%;">No</th>
                                <th style="width: 10%;">User</th>
                                <th style="width: 10%;">Tanggal Test</th>
                                <th style="width: 5%;">Total Gejala</th>
                                <th style="width: 40%;">Hasil</th>
                                <th style="width: 30%;">Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

</div>
<!-- /.container-fluid -->

<!-- script -->
<script>
    $(document).ready(function() {
        $('#usertest').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/userTestList',
            order: [],
            columns: [{
                    data: 'no',
                    orderable: false
                },
                {
                    data: 'fullname'
                },
                {
                    data: 'test_date'
                },
                {
                    data: 'jumlah_checked'
                },
                {
                    data: 'kategori'
                },
                {
                    data: 'action',
                    orderable: false
                }
            ]
        });
    });

    function confirmDelete(testId) {
        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            window.location.href = '/deleteTest/' + testId; // Ganti dengan URL endpoint penghapusan
        }
    }
</script>

<?= $this->endSection(); ?>