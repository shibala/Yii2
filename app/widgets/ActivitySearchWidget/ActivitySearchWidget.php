<?php
/**
 * Created by PhpStorm.
 */

namespace app\widgets\ActivitySearchWidget;

use app\models\ActivitySearch;
use yii\bootstrap\Widget;

class ActivitySearchWidget extends Widget
{
    public $activities;
    public $date_start;

    public function run()
    {

        $searchModel = new ActivitySearch();

        $dataProvider = $searchModel->search([], ['date_start' => $this->date_start]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}