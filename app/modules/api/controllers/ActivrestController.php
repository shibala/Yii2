<?php
/**
 * Created by PhpStorm.
 */

namespace app\modules\api\controllers;


use app\models\Activity;
use app\modules\api\ActivityRest;
use yii\filters\auth\HttpBasicAuth;
use yii\rest\ActiveController;
use app\models\Users;
use yii\filters\auth\HttpBearerAuth;

class ActivrestController extends ActiveController
{
    public $modelClass = ActivityRest::class;

    //авторизация не работает - 'Call to a member function loginByAccessToken() on string' - ???
    public function behaviors()
    {
        return array_merge([
            'authentificator' => [
                //'class' => HttpBearerAuth::class,
                'class' => HttpBasicAuth::class,
                'user' => Users::class
            ],
        ], parent::behaviors());
    }
}