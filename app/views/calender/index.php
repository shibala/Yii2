<?php
/**
 * Created by PhpStorm.
 */

use yii\bootstrap\ActiveForm;
?>
<h1><?= $model -> getToday()['year'] ?></h1>

<?php $month = 1; ?>

<div class="row">
<?php foreach($model -> getMonths() as $item): ?>


<div class="col-md-4">
    <h3><?= $model -> monthsNames[$month - 1] ?></h3>
<?php for($i = 1; $i <= $item; $i++): ?>



    <?php $form=ActiveForm::begin([
        'action' => '/day/show',
        'method' => 'POST',
        'id' => 'activity',
    ]); ?>

    <?= $form->field($day, 'date') -> label(false) -> hiddenInput(['value' =>
        \Yii::$app->sqlFormatter->asDate($model -> getToday()['year'].'-'.$month.'-'.$i)]); ?>

    <div class="form-group">
        <button type="submit" class="btn btn-default"><?= $i ?></button>
    </div>

    <?php ActiveForm::end(); ?>

<?php endfor; ?>

</div>

<?php $month += 1; ?>
<?php endforeach; ?>
</div>
