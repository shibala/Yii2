<?php
/**
 * Created by PhpStorm.
 */

namespace app\controllers;


use app\base\BaseController;
use app\models\Day;
use app\controllers\actions\DayShowAction;

/*use app\controllers\actions\DayCreateAction;*/

class DayController extends BaseController
{
    public  function actions() {

        return [
            'show' => ['class' => DayShowAction::class]
        ];
    }
}