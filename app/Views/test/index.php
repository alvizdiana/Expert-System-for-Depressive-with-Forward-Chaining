<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="test-container">
    <form action="<?= base_url('test/submit'); ?>" method="post">
        <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>
        <div class="petunjuk-pengisian">
            <h4>Petunjuk pengisian:</h4>
            <p>Pilih kondisi-kondisi yang anda alami selama kurang <b>lebih 2 minggu terakhir</b></p>

            <p>Apabila anda menganggap kondisi tersebut <b>anda alami dalam 2 minggu terakhir</b>, <b>klik checkbox</b> . Sebaliknya, apabila anda menganggap kondisi tersebut <b>tidak anda alami selama 2 minggu terakhir</b>, <b>abaikan checkbox</b>.</p>

            <p>Jika anda tidak yakin tentang jawabannya, berilah jawaban yang paling sesuai di antara YA dan TIDAK.</p>

            <p>Isilah jawaban sesuai dengan kondisi / keadaan anda yang sebenar-benarnya.</p>
            <p><b>(*) Kami tegaskan bahwa jawaban Anda bersifat rahasia dan akan digunakan hanya untuk membantu pemecahan masalah Anda.</b></p>
        </div>
        <table class="table table-test">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Pertanyaan</th>
                    <th scope="col">Ya/Tidak</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php $i = 1; ?>
                <?php foreach ($pertanyaan as $p) : ?>
                    <tr>
                        <th scope="row"><?= $i++; ?></th>
                        <td><?= $p['soal']; ?></td>
                        <td>
                            <input class="custom-checkbox" type="checkbox" name="checkboxes[]" value="<?= $p['id']; ?>">
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="tombol-submit">
            <button type="submit">Submit</button>
        </div>
    </form>
</div>

<?= $this->endSection(); ?>