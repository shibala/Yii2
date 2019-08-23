<?php

/**
 * Created by PhpStorm.
 */

/* @var $this \yii\web\View */
/* @var $model \app\models\Users */

use yii\bootstrap\ActiveForm;

?>

<h1>Авторизация</h1>
<div class="row">
    <div class="col-md-6">
        <?php $form=ActiveForm::begin([
            'method' => 'POST'
        ]); ?>

        <?= $form->field($model, 'email'); ?>
        <?= $form->field($model, 'password')->passwordInput(); ?>

        <div class="form-group">
            <button type="submit">Войти</button>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
