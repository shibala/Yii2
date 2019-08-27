<?php
/**
 * Created by PhpStorm.
 */

namespace app\controllers;

use app\models\Activity;
use app\models\Calender;
use app\base\BaseController;
use app\models\Day;

class CalenderController extends BaseController
{
    public  function actionIndex() {

        $model = \Yii::$container->get(Calender::class);;
        $dayModel = \Yii::$container->get(Day::class);
        $activities = Activity::find()->andWhere(['user_id' => \Yii::$app->session['__id']])->all();


        return $this->render('index', ['model' => $model,
                                            'dayModel' => $dayModel,
                                            'activities' => $activities]);
    }
}