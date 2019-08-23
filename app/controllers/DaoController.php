<?php
/**
 * Created by PhpStorm.
 */

namespace app\controllers;


use app\base\BaseController;
use app\components\DaoComponent;

class DaoController extends BaseController
{
    public  function actionIndex() {

        $model = new DaoComponent();

        return $this->render('index', ['model' => $model]);
    }
}