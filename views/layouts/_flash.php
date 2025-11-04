

<style>
    .btn-close, .accordion-button::after {
        background-size : 30%;
    }
</style>
<div class="container text-center" style="max-width: 100%;">

        <?php if (Yii::$app->session->getFlash('success') !== NULL && @Yii::$app->user->identity->role != 'user'){ ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?=  Yii::$app->session->getFlash('success'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>
    <?php if (Yii::$app->session->getFlash('danger') !== NULL && @Yii::$app->user->identity->role != 'user'){ ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?=  Yii::$app->session->getFlash('danger'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>

</div>
