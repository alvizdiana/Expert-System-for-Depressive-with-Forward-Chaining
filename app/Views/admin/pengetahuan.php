<?= $this->extend('layout/templateadmin'); ?>

<?= $this->section('contentdbadmin'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Basis Pengetahuan</h1>
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
                    <button type="button" class="btn btn-custom-green btn-sm" data-toggle="modal" data-target="#addKnowledgeModal">
                        <i class="fas fa-plus"></i> Add New
                    </button>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <table class="table table-sm table-bordered" id="soal" style="width: 100%;">
                        <thead>
                            <tr>
                                <th style="width: 10%;">No</th>
                                <th style="width: 70%;">Knowledge</th>
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

<!-- Modal Add Soal -->
<div class="modal fade" id="addKnowledgeModal" tabindex="-1" role="dialog" aria-labelledby="addKnowledgeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addKnowledgeModalLabel">Add New Knowledge</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addKnowledgeForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="soal">Soal</label>
                        <input type="text" class="form-control" id="soal" name="soal" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-custom-yellow" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-custom-green">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Soal -->
<div class="modal fade" id="editKnowledgeModal" tabindex="-1" role="dialog" aria-labelledby="editKnowledgeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editKnowledgeModalLabel">Edit Pengetahuan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editKnowledgeForm">
                <div class="modal-body">
                    <input type="hidden" id="editSoalId" name="id">
                    <div class="form-group">
                        <label for="editSoal">Soal</label>
                        <input type="text" class="form-control" id="editSoal" name="soal" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-custom-yellow" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-custom-green">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- script -->
<script>
    $(document).ready(function() {
        $('#soal').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/soalList',
            columnDefs: [{
                    targets: -1,
                    orderable: false
                }, //target -1 means last column
            ]
        });

        // buat modal add soal
        $('#addKnowledgeForm').on('submit', function(e) {
            e.preventDefault(); // Prevent default, biar pake ajax aja, mencegah reload window
            $.ajax({
                url: '/addSoal', // URL untuk menambah data
                type: 'POST',
                data: $(this).serialize(), //serialize = ubah data jadi encoded-string buat dikirim ke server
                success: function(response) {
                    $('#addKnowledgeModal').modal('hide'); // Close modal
                    $('#soal').DataTable().ajax.reload(); // Reload DataTable
                    alert('Data berhasil ditambahkan!'); // Notifikasi
                },
                error: function() {
                    alert('Terjadi kesalahan saat menambahkan data.');
                }
            });
        });

        // Handle form submission for editing knowledge
        $('#editKnowledgeForm').on('submit', function(e) {
            e.preventDefault(); // Prevent default form submission
            $.ajax({
                url: '/editSoal', // URL untuk mengedit data
                type: 'POST',
                data: $(this).serialize(), // Serialize form data
                success: function(response) {
                    $('#editKnowledgeModal').modal('hide'); // Close modal
                    $('#soal').DataTable().ajax.reload(); // Reload DataTable
                    alert('Data berhasil diperbarui!'); // Notifikasi
                },
                error: function() {
                    alert('Terjadi kesalahan saat memperbarui data.');
                }
            });
        });

        // Function to open edit modal and populate data
        window.openEditModal = function(id, soal) {
            $('#editSoalId').val(id); // Set the hidden input with the ID
            $('#editSoal').val(soal); // Set the input with the current question
            $('#editKnowledgeModal').modal('show'); // Show the edit modal
        }
    });

    function deleteSoal(id) {
        if (confirm('Are you sure you want to delete this question?')) {
            $.ajax({
                url: '/deleteSoal/' + id,
                type: 'DELETE',
                success: function(response) {
                    console.log(response); // Log the response for debugging
                    if (response.status === 'success') {
                        // Refresh DataTable atau lakukan tindakan lain setelah berhasil dihapus
                        $('#soal').DataTable().ajax.reload();
                    } else {
                        alert('Error deleting the question.');
                    }
                },
                error: function() {
                    alert('Error deleting the question.');
                }
            });
        }
    }
</script>

<?= $this->endSection(); ?>