<?php

use yii\helpers\Url;
?>
<div class="row h-100">
    <div class="col-12 col-md-6 col-lg-5 col-xl-3 mx-auto py-4 text-center align-self-center">
        <figure class="mw-100 text-center mb-3">
            <div id="myAnimation" style="width:400px; height:400px;"></div>
        </figure>        
        <h3 class="mb-0 text-color-theme">Tidak Terautentikasi! <?= $title ?></h3>
        <p><?= $message ?></p>
        <h5 class="mb-3">Akses Dibatasi (401 Unauthorized)</h5>
        <p class="text-muted mb-4">
            Anda belum masuk ke sistem atau sesi Anda telah berakhir.
            Untuk melanjutkan, silakan login terlebih dahulu agar dapat mengakses halaman ini.
            <br>Jika Anda sudah login namun tetap melihat pesan ini, coba muat ulang halaman atau hubungi administrator.
        </p>
        <a href="<?= Url::base() ?>/site/login" target="_self" class="btn btn-default btn-lg rounded p-3">
            Login Sekarang
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