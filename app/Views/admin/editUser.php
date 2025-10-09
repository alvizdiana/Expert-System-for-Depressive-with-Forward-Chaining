<?= $this->extend('layout/templateadmin'); ?>

<?= $this->section('contentdbadmin'); ?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Edit User</h1>

    <form action="/updateUser/<?= $userDetail->users_id; ?>" method="post">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= $userDetail->email; ?>" required>
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="<?= $userDetail->username; ?>" required>
        </div>
        <div class="form-group">
            <label for="fullname">Fullname</label>
            <input type="text" class="form-control" id="fullname" name="fullname" value="<?= $userDetail->fullname; ?>" required>
        </div>
        <div class="form-group">
            <label for="birthday">Birthday</label>
            <input type="date" class="form-control" id="birthday" name="birthday" value="<?= $userDetail->birthday; ?>" required>
        </div>
        <div class="form-group">
            <label for="active">Status</label>
            <select class="form-control" id="active" name="active">
                <option value="1" <?= $userDetail->active ? 'selected' : ''; ?>>Active</option>
                <option value="0" <?= !$userDetail->active ? 'selected' : ''; ?>>Inactive</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update User</button>
        <button type="submit" class="btn btn-primary" href='users'>Batal</button>
    </form>
</div>

<?= $this->endSection(); ?>