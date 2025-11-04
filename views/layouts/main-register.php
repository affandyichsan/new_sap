<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\bootstrap5\Html as Bootstrap5Html;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Bootstrap5Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Favicons -->

    <!-- Google fonts-->

    <!-- <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&amp;display=swap" rel="stylesheet"> -->

    <!-- bootstrap icons -->
    <link href="<?= Url::base(); ?>/vender/icofont/icofont.min.css" rel="stylesheet">

    <!-- swiper carousel css -->
    <link rel="stylesheet" href="<?= Url::base()?>/assets_web/vendor/swiperjs-6.6.2/swiper-bundle.min.css">

    <!-- style css for this template -->
    <link href="<?= Url::base()?>/assets_web/css/style.css" rel="stylesheet" id="style">
</head>
<body class="body-scroll" data-page="index">
<?php $this->beginBody() ?>

<?= $this->render('_loader_section'); ?>
<?= $this->render('_sidebar_main_menu'); ?>

<main class="h-100">
    <div class="main-container container">
        <?= $content ?>
    </div>
</main>
<?php //$this->render('_toast_message'); ?>


    <!-- Required jquery and libraries -->
    <script src="<?= Url::base()?>/assets_web/js/jquery-3.3.1.min.js"></script>
    <script src="<?= Url::base()?>/assets_web/js/popper.min.js"></script>
    <script src="<?= Url::base()?>/assets_web/vendor/bootstrap-5/js/bootstrap.bundle.min.js"></script>

    <!-- cookie js -->
    <script src="<?= Url::base()?>/assets_web/js/jquery.cookie.js"></script>

    <!-- Customized jquery file  -->
    <script src="<?= Url::base()?>/assets_web/js/main.js"></script>
    <script src="<?= Url::base()?>/assets_web/js/color-scheme.js"></script>

    <!-- PWA app service registration and works -->
    <script src="<?= Url::base()?>/assets_web/js/pwa-services.js"></script>

    <!-- Chart js script -->
    <script src="<?= Url::base()?>/assets_web/vendor/chart-js-3.3.1/chart.min.js"></script>

    <!-- Progress circle js script -->
    <script src="<?= Url::base()?>/assets_web/vendor/progressbar-js/progressbar.min.js"></script>

    <!-- swiper js script -->
    <script src="<?= Url::base()?>/assets_web/vendor/swiperjs-6.6.2/swiper-bundle.min.js"></script>

    <!-- page level custom script -->
    <script src="<?= Url::base()?>/assets_web/js/app.js"></script>

    <script defer src="<?= Url::base()?>/fontawesome/js/brands.js"></script>
    <script defer src="<?= Url::base()?>/fontawesome/js/solid.js"></script>
    <script defer src="<?= Url::base()?>/fontawesome/js/fontawesome.js"></script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
<script>
        function password_show_hide() {
            var x = document.getElementById("loginform-password");
            var show_eye = document.getElementById("show_eye");
            var hide_eye = document.getElementById("hide_eye");
            hide_eye.classList.remove("d-none");
            if (x.type === "password") {
                x.type = "text";
                show_eye.style.display = "none";
                hide_eye.style.display = "block";
            } else {
                x.type = "password";
                show_eye.style.display = "block";
                hide_eye.style.display = "none";
            }
        }
        function password_show_hide_confrim() {
            var x = document.getElementById("loginform-password-c");
            var show_eye = document.getElementById("show_eye_c");
            var hide_eye = document.getElementById("hide_eye_c");
            hide_eye.classList.remove("d-none");
            if (x.type === "password") {
                x.type = "text";
                show_eye.style.display = "none";
                hide_eye.style.display = "block";
            } else {
                x.type = "password";
                show_eye.style.display = "block";
                hide_eye.style.display = "none";
            }
        }

    </script>