<?php
/**
 * Created by PhpStorm.
 */

namespace app\controllers;

use app\base\BaseController;
use app\components\ActivityComponent;
use app\controllers\actions\ActivityConfirmAction;
use app\controllers\actions\ActivityCreateAction;
use yii\web\HttpException;


class ActivityController extends BaseController
{
    public  function actions() {
        return [
            'create' => ['class' => ActivityCreateAction::class],
            'confirm' => ['class' => ActivityConfirmAction::class],
            'edit' => ['class' => ActivityCreateAction::class]
        ];
    }

    public function actionView($id)
    {


            /** @var ActivityComponent $comp */
            $comp = \Yii::$app->activity;

            $activity = $comp->getActivity($id);

        if (!$activity) {
            throw new HttpException(404, 'Активность не найдена');
        }

            if (!\Yii::$app->rbac->canViewEditAll()) {
                if (!\Yii::$app->rbac->canViewActivity($activity)) {
                    throw new HttpException(403, 'Нет доступа для просмотра этой активности');
                }
            }



        return $this->render('create-confirm', ['activity' => $activity]);
    }

}