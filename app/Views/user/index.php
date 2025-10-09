<?= $this->extend('layout/templatedb'); ?>

<?= $this->section('contentdbuser'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 heading-text">History Test Results</h1>
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
                    <h6 class="m-0 font-weight-bold text-dark">Recent Test</h6>
                    <a href='/'>
                        <h6 class="m-0 font-weight-bold text-dark">Home</h6>
                    </a>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <table class="table table-striped table-hover" id="usertest" style="width: 100%;">
                        <thead>
                            <tr>
                                <th style="width: 5%;">No</th>
                                <th style="width: 10%;">Tanggal Test</th>
                                <th style="width: 5%;">Total Gejala</th>
                                <th style="width: 60%;">Hasil</th>
                                <th style="width: 20%;">Action</th>
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
            ajax: '/testResult',
            order: [],
            columnDefs: [{
                    targets: -1,
                    orderable: false
                }, //target -1 means last column
            ]
        });
    });
</script>

<?= $this->endSection(); ?>