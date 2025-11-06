<?php

use yii\helpers\Url;
?>
<div class="row h-100">
    <div class="col-12 col-md-6 col-lg-5 col-xl-3 mx-auto py-4 text-center align-self-center">
        <figure class="mw-100 text-center mb-3">
            <div id="myAnimation" style="width:400px; height:400px;"></div>
        </figure>
        <h3 class="mb-0 text-color-theme">Oops!... <?= $title ?></h3>
        <p><?= $message ?></p>
        <h5 class="mb-3">Metode Permintaan Tidak Diizinkan (405)</h5>
        <p class="text-muted mb-4">
            Server menerima permintaan Anda, tetapi metode yang digunakan tidak diizinkan untuk URL ini.
            Pastikan Anda menggunakan cara yang benar untuk mengakses halaman ini,
            seperti membuka halaman langsung melalui tautan atau tombol yang tersedia.
            <br>Jika Anda mengirim data, pastikan metode permintaan (GET/POST) sesuai dengan yang diharapkan sistem.
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
        path: '<?= Url::base() ?>/images/json/Error 404.json' // lokasi file JSON Anda
    });

    // Contoh: event ketika animasi selesai
    animation.addEventListener('complete', function() {
        console.log('Animasi selesai');
    });
</script>