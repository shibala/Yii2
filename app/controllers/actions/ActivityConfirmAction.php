<?php
/**
 * Created by PhpStorm.
 */

namespace app\controllers\actions;


use app\components\ActivityComponent;
use app\components\DayComponent;
use app\models\Activity;
use app\models\Day;
use app\models\Users;
use yii\base\Action;

class ActivityConfirmAction extends Action
{
    public function run() {

        /** @var ActivityComponent $comp */
        $comp = \Yii::$app->activity;

            $activity = $comp->getModel(\Yii::$app->request->post());


                if ($activity->confirmed) {

                    $activity->save();

                    /** @var Day $day */
                    $day = \Yii::$container->get(Day::class);
                    $day -> date = $activity -> date_start;

                    return $this->controller->render('../day/show', ['day' => $day, 'activity' => $activity]);
                }

                return $this->controller->render('create-confirm', ['activity' => $activity]);

    }
}