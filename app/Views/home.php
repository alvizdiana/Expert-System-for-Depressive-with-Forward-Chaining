<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="container">
        <div class="image-content" style="margin: 10px;">
            <a href="#img-content">
                <img src="/img/mami.png" alt="dokter">
            </a>
        </div>
    </div>
</div>
<div class="text-content">
    <p>Setiap individu memiliki hak yang sama untuk menikmati kesejahteraan mental yang optimal, tanpa terkecuali. EmPart System hadir sebagai solusi yang mendukung kebutuhan masyarakat dalam menjaga kesehatan mental mereka melalui layanan inovatif yang memungkinkan Anda untuk mengevaluasi dan memahami kondisi psikologis secara efektif</p>
    <p>Dengan memanfaatkan teknologi terkini, kami bertujuan untuk memberikan pengalaman yang nyaman dan informatif dalam mendukung perjalanan Anda menuju keseimbangan mental yang lebih baik.</p>
</div>
<h6 style="text-align: center; padding:20px;">Klik tombol di bawah untuk memulai tes</h6>
<div class="tombol-mulai">
    <button><a href="/test">Mulai</a></button>
</div>
<?= $this->endSection(); ?>