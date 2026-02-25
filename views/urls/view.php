<?php

use yii\bootstrap5\Html;
?>
<div class="row">
    <div class="col-lg-2"></div>
    <div class="col-lg-4">
        <?= Html::img('data:image/png;base64,' . base64_encode($model->qr)); ?>            </div>
    <div class="col-lg-4">
        <?= Html::a('Перейти', $model->transitionUrl) ?>
    </div>
    <div class="col-lg-2"></div>
</div>            
