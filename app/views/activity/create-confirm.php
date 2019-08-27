<?php
/**
 * Created by PhpStorm.
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;


//var_dump($activity -> validate());
?>

<dev class="row">
    <p>Вы ввели следующую информацию</p>
    <ul>
        <li><label>ID</label>: <?= Html::encode($activity->user_id) ?></li>
        <li><label>Заголовок</label>: <?= Html::encode($activity->title) ?></li>
        <li><label>Описание</label>: <?= Html::encode($activity->description) ?></li>
        <li><label>Дата начала</label>: <?= Html::encode($activity->date_start) ?></li>
        <li><label>Дата окончания</label>: <?= Html::encode($activity->date_end) ?></li>
        <li><label>Блокирующее</label>: <?= Html::encode($activity->is_blocked) ?></li>
        <li><label>Повторяющееся</label>: <?= Html::encode($activity->is_repeat) ?></li>
        <li><label>Уведомление</label>: <?= Html::encode($activity->user_notification) ?></li>
        <li><label>Email</label>: <?= Html::encode($activity->email) ?></li>
        <li><label>Image</label>: <?= Html::encode($activity->image) ?></li>
        <li><img src="/images/<?= $activity->image ?>" </li>
    </ul>
</dev>

<?php $form=ActiveForm::begin([
    'action' => '/activity/edit',
    'method' => 'POST',
    'id' => 'activity',
/*    'options' => [
        'enctype' => ''
    ]*/
]); ?>

<?= $form->field($activity, 'title') -> label(false) -> hiddenInput(['value' => Html::encode($activity->title)]); ?>
<?= $form->field($activity, 'description') -> label(false) -> hiddenInput(['value' => Html::encode($activity->description)]); ?>
<?= $form->field($activity, 'date_start') -> label(false) -> hiddenInput(['value' => Html::encode($activity->date_start)]); ?>
<?= $form->field($activity, 'date_end') -> label(false) -> hiddenInput(['value' => Html::encode($activity->date_end)]); ?>
<?= $form->field($activity, 'is_blocked') -> label(false) -> hiddenInput(['value' => Html::encode($activity->is_blocked)]); ?>
<?= $form->field($activity, 'is_repeat') -> label(false) -> hiddenInput(['value' => Html::encode($activity->is_repeat)]); ?>
<?= $form->field($activity, 'user_notification') -> label(false) -> hiddenInput(['value' => Html::encode($activity->user_notification)]); ?>
<?= $form->field($activity, 'email') -> label(false) -> hiddenInput(['value' => Html::encode($activity->email)]); ?>

<div class="form-group">
    <button type="submit" class="btn btn-default">Редактировать</button>
</div>

<?php ActiveForm::end(); ?>

<?php $form=ActiveForm::begin([
    'action' => '/activity/confirm',
    'method' => 'POST',
    'id' => 'activity',
    /*    'options' => [
            'enctype' => ''
        ]*/
]); ?>

<?= $form->field($activity, 'title') -> label(false) -> hiddenInput(['value' => Html::encode($activity->title)]); ?>
<?= $form->field($activity, 'description') -> label(false) -> hiddenInput(['value' => Html::encode($activity->description)]); ?>
<?= $form->field($activity, 'date_start') -> label(false) -> hiddenInput(['value' => Html::encode($activity->date_start)]); ?>
<?= $form->field($activity, 'date_end') -> label(false) -> hiddenInput(['value' => Html::encode($activity->date_end)]); ?>
<?= $form->field($activity, 'is_blocked') -> label(false) -> hiddenInput(['value' => Html::encode($activity->is_blocked)]); ?>
<?= $form->field($activity, 'is_repeat') -> label(false) -> hiddenInput(['value' => Html::encode($activity->is_repeat)]); ?>
<?= $form->field($activity, 'email') -> label(false) -> hiddenInput(['value' => Html::encode($activity->email)]); ?>

<?= $form->field($activity, 'confirmed') -> label(false) -> hiddenInput(['value' => true]); ?>
<div class="form-group">
    <button type="submit" class="btn btn-default">Сохранить в БД</button>
</div>

<?php ActiveForm::end(); ?>
