<?php
/**
 * Created by PhpStorm.
 */

namespace app\commands;


use app\components\NotificationComponent;
use app\models\ActivitySearch;
use yii\helpers\Console;
use yii\console\Controller;

class NotificationController extends Controller
{

    /*public $param;

    function options($actionID)
    {
        return ['param'];
    }

    function optionAliases()
    {
        return ['p' => 'param'];
    }

    public function actionParam() {
        echo 'param '.$this->param.PHP_EOL;
    }

    public function actionIndex(...$args){
        echo $this->ansiFormat('this is console'.PHP_EOL, Console::FG_YELLOW);
        echo 'param '.print_r($args).PHP_EOL;
    }*/




    public function actionNotification()
    {
        $activities = new ActivitySearch();
        $activities = $activities->getActivitiesToday();


        /** @var NotificationComponent $notif_comp */
        $notif_comp=\Yii::createObject(['class'=>NotificationComponent::class, 'mailer'=>\Yii::$app->mailer]);

        foreach ($notif_comp->sendTodayNotification($activities) as $result) {
            if ($result['result']){
                echo $this->ansiFormat('Успешно отправлено письмо на '.$result['email'], Console::FG_GREEN);
            } else {
                echo $this->ansiFormat('Ошибка отправки письма на '.$result['email'], Console::FG_REd);
            }
        }
    }

}