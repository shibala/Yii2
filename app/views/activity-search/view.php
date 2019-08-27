<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Activity */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Activities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="activity-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'description:ntext',
            [
                'attribute' => 'date_start',
                'value' => function($model){
                    return Yii::$app->viewFormatter->asDate($model->date_start);
                },
            ],
            [
                'attribute' => 'date_end',
                'value' => function($model){
                    return Yii::$app->viewFormatter->asDate($model->date_start);
                },
            ],
            [
                'attribute' => 'user_notification',
                'value' => function($model){
                    return ($model->user_notification == 0) ? 'нет' : 'да';
                },
            ],
            [
                'attribute' => 'is_blocked',
                'value' => function($model){
                    return ($model->is_blocked == 0) ? 'нет' : 'да';
                },
            ],
            [
                'attribute' => 'is_repeat',
                'value' => function($model){
                    return ($model->is_repeat == 0) ? 'нет' : 'да';
                },
            ],
            [
                'attribute' => 'date_created',
                'value' => function($model){
                    return Yii::$app->viewFormatter->asDate($model->date_start);
                },
            ],
            'user_id',
        ],
    ]) ?>

</div>
