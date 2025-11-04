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
if(Yii::$app->user->isGuest){
    Yii::$app->session->setFlash("danger", "Maaf anda harus login dulu");
    Yii::$app->response->redirect(['site/login'])->send();    
}else{
    if (Yii::$app->user->identity->role != 'ADMIN') {   
        Yii::$app->session->setFlash('danger', "Maaf anda tidak dapat mengakses");
        Yii::$app->response->redirect(['site/index'])->send();
    }
}
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Favicons -->

    <!-- Google fonts-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&amp;display=swap" rel="stylesheet">
       <!-- bootstrap icons -->
       <link href="<?= Url::base(); ?>/vender/icofont/icofont.min.css" rel="stylesheet">

    <!-- ========================================================================================================================== -->
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?= Url::base()?>/assets_admin/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?= Url::base()?>/assets_admin/vendors/iconfonts/ionicons/dist/css/ionicons.css">
    <link rel="stylesheet" href="<?= Url::base()?>/assets_admin/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="<?= Url::base()?>/assets_admin/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="<?= Url::base()?>/assets_admin/vendors/css/vendor.bundle.addons.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?= Url::base()?>/assets_admin/css/shared/style.css">
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="<?= Url::base()?>/assets_admin/css/demo_1/style.css">
    <!-- =============================================================================================================== -->
</head>
<style>
    .content-wrapper {
        padding: 5rem 1.7rem;
    }
    .sidebar > .nav {
        padding: 5rem 1.6rem;
    }
</style>
<body>
<?php $this->beginBody() ?>
<div class="container-scroller">
    <?= $this->render('main-admin/_navbar'); ?>
    <div class="container-fluid page-body-wrapper">
        <?= $this->render('main-admin/_sidebar'); ?>
        <div class="main-panel">
            <div class="content-wrapper">
                <?php //$this->render('_flash'); ?>
                <?= $content ?>
            </div>      
            <!-- footer -->
            <?= $this->render('main-admin/_footer'); ?>
        </div>
    </div>
</div>

    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="<?= Url::base()?>/assets_admin/vendors/js/vendor.bundle.base.js"></script>
    <script src="<?= Url::base()?>/assets_admin/vendors/js/vendor.bundle.addons.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="<?= Url::base()?>/assets_admin/js/shared/off-canvas.js"></script>
    <script src="<?= Url::base()?>/assets_admin/js/shared/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="<?= Url::base()?>/assets_admin/js/demo_1/dashboard.js"></script>
    <!-- End custom js for this page-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
