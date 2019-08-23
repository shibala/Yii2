<?php
/**
 * Created by PhpStorm.
 */

namespace app\components;


use app\models\Activity;
use yii\base\Component;
use yii\mail\MailerInterface;

class NotificationComponent extends Component
{
    /** @var MailerInterface */

    public $mailer;

    /**
     * @param $activities Activity[]
     * @return \Generator
     */

    public function sendTodayNotification($activities)
    {
        foreach ($activities as $activity) {
            $result = $this->mailer->compose('notification', ['model' => $activity])
                ->setFrom('kirasirTest@yandex.ru')
                ->setTo([$activity->user->email])
                ->setSubject('События на сегодня')
                ->setReplyTo('kirasirTest@yandex.ru')
                ->attach(\Yii::getAlias('@app/web/images/72341551458286.jpg'))
                ->setCharset('utf8')
                ->send();
            yield ['result' => $result, 'email' => $activity->user->email];
        }
    }
}