<?php

use app\models\Action;
use app\models\ActionHutang;
use app\models\ActionPembukuan;
use app\models\ActionSap;
use app\models\ActionUser;
use app\models\ProfileUser;
use yii\helpers\Url;

$data = ActionSap::getDataUser();
?>
<div class="sidebar-wrap  sidebar-pushcontent">
    <!-- Add overlay or fullmenu instead overlay -->
    <div class="closemenu text-muted">Close Menu</div>
    <div class="sidebar" style="background-color:#053b1f;">
        <!-- user information -->
        <div class="row my-3">
            <div class="col-12 ">
                <div class="card shadow-sm text-black border-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-auto">
                                <figure class="avatar avatar-44 rounded-15">
                                    <img src="<?= Url::base() ?>/assets_web/images/unknow-people.png" class="card-img-top rounded-4 mb-2">
                                    <?php //} else { 
                                    ?>
                                    <img src="<?php //Url::base() 
                                                ?>/assets_web/img/user1.jpg" alt="" class="card-img-top rounded-4 mb-2">
                                    <?php //} 
                                    ?>
                                </figure>
                            </div>
                            <div class="col px-0 align-self-center">
                                <h6 class="mb-1 text-muted"><?= @$data['nama_karyawan'] ?></h6>
                                <p class="text-muted size-12"><?= @$data['nrp_bib'] ?></p>
                            </div>
                            <!-- <div class="col-auto">
                                    <button class="btn btn-44 btn-light">
                                        <i class="icofont-arrow-right icon"></i>
                                    </button>
                                </div> -->
                        </div>
                    </div>
                    <div class="card text-black border-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-auto">
                                    <p class="text-muted size-12"><?= @$data['departemen'] ?> | <?= @$data['jabatan'] ?></p>
                                    <h6 class="display-7 text-muted">NRP : <?= @$data['nrp'] ?></h6>
                                </div>
                                <div class="col text-end">
                                </div>
                            </div>
                        </div>
                        <?php //if (ActionHutang::totalHutang() != 0 || ActionHutang::totalHutang() != null) { 
                        ?>
                        <!-- <div class="card-body">
                                <div class="row">
                                    <div class="col-auto">
                                        <p class="text-muted">Total Hutang</p>
                                    </div>
                                    <div class="col-12">
                                        <h3 class="display-7"><?php //rupiah(ActionHutang::totalHutang()) 
                                                                ?></h3>
                                    </div>
                                    <div class="col text-end">
                                    </div>
                                </div>
                            </div> -->
                        <?php //} 
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- user emnu navigation -->
        <div class="row">
            <div class="col-12">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?= Url::base() ?>/dashboard/index">
                            <div class="avatar avatar-40 rounded icon">
                                <i class="icofont-home"></i>
                            </div>
                            <div class="col">Dashboard</div>
                            <div class="arrow"><i class="icofont-curved-right"></i></div>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                            <div class="avatar avatar-40 rounded icon">
                                <i class="icofont-handshake-deal"></i>
                            </div>
                            <div class="col">CEK SAP</div>
                            <div class="arrow"><i class="icofont-plus"></i></div>
                        </a>

                        <ul class="dropdown-menu">
                            <li>
                                <a class="nav-link dropdown-toggle" aria-current="page" href="<?= Url::base() ?>/site/index">
                                    <div class="avatar avatar-40 rounded icon"><i class="icofont-listine-dots"></i></div>
                                    <div class="col">Minggu ini</div>
                                    <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                                </a>
                            </li>
                            <li>
                                <a class="nav-link dropdown-toggle" aria-current="page" href="<?= Url::base() ?>/sap-range/perminggu">
                                    <div class="avatar avatar-40 rounded icon"><i class="icofont-arrow-up"></i>
                                    </div>
                                    <div class="col">Per-Minggu</div>
                                    <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <form id="logout-form" action="<?= Url::to(['site/logout']) ?>" method="post" style="display:none;">
                            <?= \yii\helpers\Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->getCsrfToken()) ?>
                        </form>
                        <a class="nav-link" href="#" onclick="document.getElementById('logout-form').submit(); return false;">
                            <div class="avatar avatar-40 rounded icon">
                                <i class="icofont-sign-out"></i>
                            </div>
                            <div class="col">Logout</div>
                            <div class="arrow"><i class="icofont-curved-right"></i></div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>


<!-- <script text="text/javascript">
    function logout(id) {
        var obj = {
            logout: true,
        }
        $.post("<?= Url::base() ?>/site/logout", obj, function(response) {
            console.log(response);
            if (response == true) {
                location.reload();
            }
        });
    }
</script> -->