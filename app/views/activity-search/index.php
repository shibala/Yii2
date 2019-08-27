<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

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
        [
            'attribute' => 'date_end',
            'value' => function($model){
                return Yii::$app->viewFormatter->asDate($model->date_start);
            },
        ],
        //'user_notification',
        //'is_blocked',
        //'is_repeat',
        //'date_created',
        /*'user_id',
        [
            'attribute' => 'email',
            'label' => 'email',
            'value' => function($model) {
                return $model->user->email;
            }
        ],*/

        /*['class' => 'yii\grid\ActionColumn']*/
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

$gridParams['columns'][] = ['class' => 'yii\grid\ActionColumn'];


?>
<div class="activity-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Activity', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget($gridParams); ?>
</div>
