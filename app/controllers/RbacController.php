<?php
/**
 * Created by PhpStorm.
 */

namespace app\controllers;


use yii\web\Controller;

class RbacController extends Controller
{
    public function actionGen() {
        \Yii::$app->rbac->generateRbacRules();
    }
}