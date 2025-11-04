<?php

use yii\helpers\Url;

?>
<header class="header position-fixed">
    <div class="row">
        <div class="col-auto">
            <a href="javascript:void(0)" target="_self" class="btn btn-light btn-44 menu-btn">
                <i class="icofont-listine-dots"></i>
            </a>
        </div>
        <div class="col align-self-center text-center">
            <!-- <div class="logo-small">
                <img src="<?= Url::base()?>/assets_web/images/Logo-SIC.png" alt="">
            </div> -->
        </div>
        <div class="col-auto">
            <a href="<?= Url::base()?>/profile-user/index" target="_self" class="btn btn-light btn-44">
                <i class="icofont-user-alt-7"></i>
                <span class="count-indicator"></span>
            </a>
        </div>
    </div>
</header>