<?php

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\helpers\Url;

$this->title = 'Qr';
?>
<div class="site-index">

    <div class="body-content" id="body-content">
        <div class="row">
            <div class="col-lg-5">
                <?php
                $form = ActiveForm::begin([
                    'id' => 'url-form',
                    'action' => Url::toRoute('urls/add-url'),
                    'enableAjaxValidation' => true,
                    'validationUrl' => Url::toRoute('urls/validation')
                ]);
                ?>

                    <?= $form->field($model, 'url')->textInput(['autofocus' => true])->label('Введите URL ссылки')->hint('http:: или https ну и далее все атрибуты') ?>

                <div class="form-group">
                <?= Html::button('OK', ['id' => 'ok-btn', 'class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>            

    </div>
</div>
