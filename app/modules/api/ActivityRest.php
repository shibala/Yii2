<?php
/**
 * Created by PhpStorm.
 */

namespace app\modules\api;


use app\models\Activity;

class ActivityRest extends Activity
{
    //То, что выдается для REST api
    public function fields()
    {
        return [
            'id', 'title', 'description',
            'user_email' => function($model){
                return $model->user->email;
            },

        ];
    }

    //То, что выдается для REST api по дополнительному запросу
    public function extraFields()
    {
        return [
            'date_start', 'date_end',
            'user_notification' => function($model){
                return $model->user_notification?'Oui':'Non';
            },
            'is_repeat' => function($model){
                return $model->is_repeat?'Oui':'Non';
            },
            'is_blocked' => function($model){
                return $model->is_blocked?'Oui':'Non';
            },
        ];
    }
}