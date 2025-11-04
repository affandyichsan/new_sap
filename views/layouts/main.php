<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\controllers\SiteController;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Url;

// $session = Yii::$app->session;
// if (!$session->has('nrp') || !$session->has('perusahaan')) {
//     Yii::$app->session->setFlash('danger', 'pastikan login dulu!');
//     return $this->redirect(['login']);
// }
// if (Yii::$app->user->isGuest) {
//     Yii::$app->session->setFlash('danger', "Maaf anda tidak dapat mengakses sebelum anda login");
//     Yii::$app->response->redirect(['site/login'])->send();
// }
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

    <!-- Favicons -->

    <!-- Google fonts-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&amp;display=swap" rel="stylesheet">

    <!-- bootstrap icons -->
    <link href="<?= Url::base(); ?>/vender/icofont/icofont.min.css" rel="stylesheet">

    <!-- swiper carousel css -->
    <link rel="stylesheet" href="<?= Url::base() ?>/assets_web/vendor/swiperjs-6.6.2/swiper-bundle.min.css">

    <!-- style css for this template -->
    <link href="<?= Url::base() ?>/assets_web/css/style.css" rel="stylesheet" id="style">

    <script defer src="<?= Url::base() ?>/fontawesome/js/brands.js"></script>
    <script defer src="<?= Url::base() ?>/fontawesome/js/solid.js"></script>
    <script defer src="<?= Url::base() ?>/fontawesome/js/fontawesome.js"></script>
</head>

<body class="body-scroll" data-page="index">
    <?php $this->beginBody() ?>
    <div class="container">
        <?= $this->render('_loader_section'); ?>
        <?= $this->render('_sidebar_main_menu'); ?>
        <main>
            <?= $this->render('_header'); ?>
            <div class="main-container container">
                <?php
                if (!Yii::$app->user->isGuest) {
                    echo $this->render('@app/views/layouts/_flash');
                    echo $content;
                } else {
                    echo $this->render('@app/views/layouts/_flash');
                    Yii::$app->response->redirect(['site/login'])->send();
                    Yii::$app->end();
                }
                ?>
            </div>
        </main>
        <!-- footer -->
        <?= $this->render('_footer'); ?>
        <?php //$this->render('_toast_message');
        ?>
    </div>


    <!-- Required jquery and libraries -->
    <script src="<?= Url::base() ?>/assets_web/js/jquery-3.3.1.min.js"></script>
    <script src="<?= Url::base() ?>/assets_web/js/popper.min.js"></script>
    <script src="<?= Url::base() ?>/assets_web/vendor/bootstrap-5/js/bootstrap.bundle.min.js"></script>

    <!-- cookie js -->
    <script src="<?= Url::base() ?>/assets_web/js/jquery.cookie.js"></script> <!-- UNCOMMENT BARIS INI -->

    <!-- Customized jquery file  -->
    <script src="<?= Url::base() ?>/assets_web/js/main.js"></script>
    <script src="<?= Url::base() ?>/assets_web/js/color-scheme.js"></script>

    <!-- PWA app service registration and works -->
    <script src="<?= Url::base() ?>/assets_web/js/pwa-services.js"></script>

    <!-- Chart js script -->
    <script src="<?= Url::base() ?>/assets_web/vendor/chart-js-3.3.1/chart.min.js"></script>

    <!-- Progress circle js script -->
    <script src="<?= Url::base() ?>/assets_web/vendor/progressbar-js/progressbar.min.js"></script>

    <!-- swiper js script -->
    <script src="<?= Url::base() ?>/assets_web/vendor/swiperjs-6.6.2/swiper-bundle.min.js"></script>

    <!-- page level custom script -->
    <script src="<?= Url::base() ?>/assets_web/js/app.js"></script>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>