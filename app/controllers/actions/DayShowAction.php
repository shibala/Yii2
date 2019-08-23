<?php
/**
 * Created by PhpStorm.
 */

namespace app\controllers\actions;

use yii\base\Action;

class DayShowAction extends Action
{
    public function run() {

        $comp = \Yii::$app->day;

        if (\Yii::$app->request->isPost) {
            $day = $comp->getModel(\Yii::$app->request->post());
        } else {
            $day = $comp->getModel();
        }

        $activity = \Yii::$app->activity->getModel();


        return $this->controller->render('show', ['day' => $day, 'activity' => $activity]);
    }
}