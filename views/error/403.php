<?php

use yii\helpers\Url;
?>
<div class="row h-100">
    <div class="col-12 col-md-6 col-lg-5 col-xl-3 mx-auto py-4 text-center align-self-center">
        <figure class="mw-100 text-center mb-3">
            <div id="myAnimation" style="width:400px; height:400px;"></div>
        </figure>
        <h3 class="mb-0 text-color-theme">Akses Ditolak! <?= $title ?></h3>
        <p><?= $message ?></p>
        <h5 class="mb-3">Anda Tidak Memiliki Izin</h5>
        <p class="text-muted mb-4">
            Maaf, Anda tidak memiliki izin untuk mengakses halaman ini.
            Mungkin akun Anda tidak memiliki hak akses yang diperlukan atau halaman ini dibatasi untuk pengguna tertentu.
            <br>Silakan kembali ke beranda atau hubungi administrator jika Anda merasa ini adalah kesalahan.
        </p>
        <a href="<?= Url::base() ?>/site/index" target="_self" class="btn btn-default btn-lg rounded p-3">
            Kembali ke Beranda
        </a>
    </div>
</div>

<script>
    var animation = lottie.loadAnimation({
        container: document.getElementById('myAnimation'), // elemen DOM
        renderer: 'svg',
        loop: true,
        autoplay: true,
        path: '<?= Url::base() ?>/images/json/Webpage error.json' // lokasi file JSON Anda
    });

    // Contoh: event ketika animasi selesai
    animation.addEventListener('complete', function() {
        console.log('Animasi selesai');
    });
</script>