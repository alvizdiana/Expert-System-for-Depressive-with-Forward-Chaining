<?= $this->extend('layout/templateadmin'); ?>

<?= $this->section('contentdbadmin'); ?>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">User Profile</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
        class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
    </div>
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-xl col-lg">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-dark">User profile</h6>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>ID</th>
                            <td><?= esc($data['id']) ?></td>
                        </tr>
                        <tr>
                            <th>Username</th>
                            <td><?= esc($data['username']) ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?= esc($data['email']) ?></td>
                        </tr>
                        <tr>
                            <th>Nama Lengkap</th>
                            <td><?= esc($data['fullname']) ?></td>
                        </tr>
                        <tr>
                            <th>Tanggal Lahir</th>
                            <td><?= esc($data['birthday']) ?></td>
                        </tr>
                        <tr>
                            <th>Akun Dibuat</th>
                            <td><?= esc($data['created_at']) ?></td>
                        </tr>
                    </table>
                    <div class="buttons d-flex flex-collumn align-items">
                        <div class="up-button-edit" style="margin-right: 10px;">
                            <button class="btn btn-custom-yellow" data-toggle="modal" data-target="#editProfileModal">Edit Profile</button>
                        </div>
                        <div class="up-button-delete">
                            <button class="btn btn-danger" data-toggle="modal" data-target="#deleteAccountModal">Delete Account</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Profile -->
<div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('/updateAdProfile') ?>" method="post">
                <div class="modal-body">
                    <input type="hidden" name="id" value="<?= esc($data['id']) ?>">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?= esc($data['username']) ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= esc($data['email']) ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="fullname">Nama Lengkap</label>
                        <input type="text" class="form-control" id="fullname" name="fullname" value="<?= esc($data['fullname']) ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="birthday">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="birthday" name="birthday" value="<?= esc($data['birthday']) ?>" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-custom-yellow" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-custom-green">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Delete Account -->
<div class="modal fade" id="deleteAccountModal" tabindex="-1" role="dialog" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteAccountModalLabel">Delete Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus akun ini? Tindakan ini tidak dapat dibatalkan.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form action="<?= base_url('/deleteAdAccount') ?>" method="post">
                    <input type="hidden" name="id" value="<?= esc($data['id']) ?>">
                    <button type="submit" class="btn btn-danger">Delete Account</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>