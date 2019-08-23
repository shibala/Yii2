<?php
/**
 * Created by PhpStorm.
 */

namespace app\controllers;


use app\base\BaseController;
use app\components\DaoComponent;
use yii\filters\PageCache;

class DaoController extends BaseController
{

    public function behaviors()
    {
        return [
          'class' => PageCache::class,
          'only' => ['index'],
          'duration' => 10
        ];
    }


    public  function actionIndex() {

        $model = new DaoComponent();

        return $this->render('index', ['model' => $model]);
    }

    public function actionCache() {
        \Yii::$app->cache->set('key1', 'value1');
        $value = \Yii::$app->cache->get('key1');

        echo $value;
    }
}