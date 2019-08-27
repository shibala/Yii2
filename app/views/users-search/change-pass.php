<?php

/**
 * Created by PhpStorm.
 */

/* @var $this \yii\web\View */
/* @var $model \app\models\Users */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

?>

<h1><?= Yii::t('app', 'Change password of user', ['name' => $model->name]); ?></h1>
<div class="row">
    <div class="col-md-6">
        <?php $form=ActiveForm::begin([
            'method' => 'POST'
        ]); ?>

        <?= $form->field($model,'password')->passwordInput(); ?>

        <?= $form->field($model, 'new_password')->passwordInput(); ?>
        <?= $form->field($model, 'new_password_repeat')->passwordInput(); ?>

        <div class="form-group">
            <button type="submit" class="btn btn-success"><?= Yii::t('app', 'Change password') ?></button>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>