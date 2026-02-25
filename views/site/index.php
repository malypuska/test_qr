<?php

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\helpers\Url;

$this->title = 'Qr';
?>
<div class="site-index">

    <div class="body-content" id="body-content">
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-6">
                <?php
                $form = ActiveForm::begin([
                    'layout'=>'horizontal',
                    'id' => 'url-form',
                    'action' => Url::toRoute('urls/add-url'),
                    'enableAjaxValidation' => true,
                    'validationUrl' => Url::toRoute('urls/validation'),
                    'class' => 'form-horizontal',
                ]);
                ?>

                <?= Html::button('OK', ['id' => 'ok-btn', 'class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                
                <?= $form->field($model, 'url')->textInput(['autofocus' => true, 'placeholders' => 'Введите URL ссылки'])->label(false)->hint('http:: или https ну и далее все атрибуты') ?>

                <?php ActiveForm::end(); ?>
            </div>
            <div class="col-lg-4"></div>
        </div>            

    </div>
</div>
