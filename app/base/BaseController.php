<?php
/**
 * Created by PhpStorm.
 */

namespace app\base;

use yii\web\Controller;
use yii\web\HttpException;

class BaseController extends Controller
{
    /*public function beforeAction($action)
    {
        if (\Yii::$app->user->isGuest) {
            throw new HttpException(404, 'Нет доступа. Авторизуйтесь!');
        }

        return parent::beforeAction($action);
    }*/


}