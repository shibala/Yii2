<?php
/**
 * Created by PhpStorm.
 */

namespace app\components;

use app\models\Day;
use app\models\Users;
use yii\base\Component;

class DayComponent extends Component
{
    /**@var string class of day entity*/

    public $day_class;

    /**@return Day*/



    public function getModel($params=null) {


        $model = \Yii::$container->get($this -> day_class);
        $model -> user_id  = \Yii::$app->session['__id'];


        $user = \Yii::$container->get(Users::class);
        $user -> id = $model -> user_id;

        if ($params && is_array($params)) {
            $model->load($params);
        }



        $dayOfWeek = date("N", strtotime($model->date));
        $model -> is_weekend = ($dayOfWeek == 6 || $dayOfWeek == 7) ? 'выходной' : 'рабочий';


        return $model;
    }

    public function showDay(&$model):bool{
        return $model -> validate();
    }
}