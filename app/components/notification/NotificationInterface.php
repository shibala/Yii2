<?php
/**
 * Created by PhpStorm.
 */

namespace app\components\notification;


use app\models\Activity;

interface NotificationInterface
{

    /** @param $activities
     * @return \Generator
     */

    public function sendTodayNotification($activities);
}