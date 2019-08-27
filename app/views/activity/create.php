<?php


    use yii\bootstrap\ActiveForm;
    use yii\jui\DatePicker;

?>


<div class="row">
    <div class="col-md-6">
        <h2><?= Yii::t('app', 'Create Activity') ?></h2>

        <?php $form=ActiveForm::begin([
                'action' => '/activity/confirm',
                'method' => 'POST',
                'id' => 'activity',
        ]); ?>


        <?= $form->field($activity, 'title'); ?>
        <?= $form->field($activity, 'description') -> textarea(); ?>

        <?= $form->field($activity, 'date_start')->widget(DatePicker::class,
            [
                'dateFormat' => 'dd.MM.yyyy'
            ]
        ); ?>

        <?= $form->field($activity, 'date_end')->widget(DatePicker::class,
            [
                'dateFormat' => 'dd.MM.yyyy'
            ]
        ); ?>
        <?= $form->field($activity, 'is_blocked') -> checkbox(); ?>
        <?= $form->field($activity, 'is_repeat') -> checkbox(); ?>
        <?= $form->field($activity, 'user_notification') -> checkbox(); ?>
        <?= $form->field($activity, 'email'); ?>
        <?= $form->field($activity, 'image') -> fileInput();?>

        <div class="form-group">
            <button type="submit" class="btn btn-default"><?= Yii::t('app', 'Create') ?></button>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
    <a href="/calender"><button><?= Yii::t('app', 'Calender') ?></button></a>
</div>