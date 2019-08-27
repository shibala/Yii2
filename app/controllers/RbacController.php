<?php
/**
 * Created by PhpStorm.
 */

namespace app\controllers;


use app\base\BaseController;
//use yii\web\Controller;

class RbacController extends BaseController
{
    public function actionGen() {
        \Yii::$app->rbac->generateRbacRules();
    }
}