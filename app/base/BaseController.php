<?php
/**
 * Created by PhpStorm.
 */

namespace app\base;

use yii\web\Controller;
use yii\web\HttpException;

class BaseController extends Controller
{

    public function init()
    {
        $this->on('beforeAction', function ($event) {
            if (\Yii::$app->getUser()->isGuest) {
                $request = \Yii::$app->getRequest();
                // исключаем страницу авторизации или ajax-запросы
                if (!($request->getIsAjax() || strpos($request->getUrl(), 'login') !== false)) {
                    \Yii::$app->getUser()->setReturnUrl($request->getUrl());
                }
            }

        });
    }


    /*public function beforeAction($action)
    {
        if (\Yii::$app->user->isGuest) {
            throw new HttpException(404, 'Нет доступа. Авторизуйтесь!');
        }


        return parent::beforeAction($action);
    }*/


}