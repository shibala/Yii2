<?php
/**
 * Created by PhpStorm.
 *
 * @var \app\models\Activity $model
 */

?>


<h2>События на сегодня</h2>
<string><?= $model->title; ?></string>
<p style="color: green;"><?= Yii::$app->viewFormatter->asDate($model->date_start); ?></p>