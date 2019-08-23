<?php
/**
 * Created by PhpStorm.
 */


use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

?>

<h1>День</h1>

<h3><?= Yii::$app->headersFormatter->asDate($day -> date); ?></h3>
<p><?= $day->is_weekend; ?></p>

<?php $form=ActiveForm::begin([
    'action' => '/activity/create',
    'method' => 'POST',
    'id' => 'activity',
]); ?>

<?= $form->field($activity, 'date_start') -> label(false) -> hiddenInput(['value' => Html::encode($day->date)]); ?>

<div class="form-group">
    <button type="submit" class="btn btn-success">Создать задание</button>
</div>

<?php ActiveForm::end(); ?>

<a href="/calender"><button class="btn btn-success">Календарь</button></a>

<div class="col-md-12">
    <?= \app\widgets\ActivitySearchWidget\ActivitySearchWidget::widget(['date_start' => $day -> date]); ?>
</div>



