<?= $this->extend('layout/templateadmin'); ?>

<?= $this->section('contentdbadmin'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">User Detail</h1>
    </div>

    <div class="row">
        <div class="col-xl col-lg">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <a href="/users"><i class="fas fa-arrow-left"></i></a>
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Pengguna</h6>
                </div>
                <div class="card-body">
                    <p><strong>Email:</strong> <?= $userDetail['email']; ?></p>
                    <p><strong>Nama Lengkap:</strong> <?= $userDetail['fullname']; ?></p>
                    <p><strong>Username:</strong> <?= $userDetail['username']; ?></p>
                    <p><strong>Tanggal Lahir:</strong> <?= $userDetail['birthday']; ?></p>
                    <p><strong>Status:</strong> <?= $userDetail['active'] ? 'Aktif' : 'Tidak Aktif'; ?></p>
                    <p><strong>Group:</strong> <?= $userDetail['group_name']; ?></p>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?= $this->endSection(); ?>