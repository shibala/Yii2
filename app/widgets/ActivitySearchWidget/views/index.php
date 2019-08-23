<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ActivitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $model app\models\Activity */

$this->title = 'Activities';
$this->params['breadcrumbs'][] = $this->title;

$gridParams = [
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'id',
        'title',
        'description:ntext',
        [
            'attribute' => 'date_start',
            'value' => function($model){
                return Yii::$app->viewFormatter->asDate($model->date_start);
            },
        ],
        'date_end',
    ],
];

if (\Yii::$app->rbac->canViewEditAll()) {
    $gridParams['columns'][] = 'user_id';
    $gridParams['columns'][] = [
        'attribute' => 'email',
        'label' => 'email',
        'value' => function($model) {
            return $model->user->email;
        }
    ];
}

$gridParams['columns'][] = ['class' => 'app\widgets\ActivitySearchWidget\WidgetActionColumn'];


?>
<div class="activity-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget($gridParams); ?>
</div>
