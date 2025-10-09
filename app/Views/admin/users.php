<?= $this->extend('layout/templateadmin'); ?>

<?= $this->section('contentdbadmin'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Users Management</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
    </div>

    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl col-lg">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-dark">Users List</h6>

                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <table class="table table-sm table-bordered" id="users" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Email</th>
                                <th>Fullname</th>
                                <th>Birthday</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Action</th>
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
        $('#users').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/usersList',
            order: [],
            columns: [{
                    data: 'no',
                    orderable: false
                },
                {
                    data: 'email'
                },
                {
                    data: 'fullname'
                },
                {
                    data: 'birthday'
                },
                {
                    data: 'group_name'
                },
                {
                    data: 'active'
                },
                {
                    data: 'action',
                    orderable: false
                }
            ]
        });
    });

    function deleteUser(id) {
        if (confirm('Are you sure you want to delete this user?')) {
            $.ajax({
                url: '/deleteUser /' + id,
                type: 'DELETE',
                success: function(response) {
                    if (response.status === 'success') {
                        // Refresh DataTable atau lakukan tindakan lain setelah berhasil dihapus
                        $('#users').DataTable().ajax.reload();
                    } else {
                        alert('Error deleting the user.');
                    }
                },
                error: function() {
                    alert('Error deleting the user.');
                }
            });
        }
    }
</script>

<?= $this->endSection(); ?>