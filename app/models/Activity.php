<?php
/**
 * Created by PhpStorm.
 * @var $activity app\models\Activity
 */

namespace app\models;


use yii\base\Model;
use yii\web\UploadedFile;

class Activity extends ActivityBase
{

    public $email;

    /**@var UploadedFile */
    public $image;

    public $confirmed;


    public function beforeValidate()
    {

        $this->loadFile();

        if (!empty($this->date_start)) {
            $this->date_start=\Yii::$app->sqlFormatter->asDate($this->date_start);
        }

        if(!empty($this->date_end)){
            $this->date_end=\Yii::$app->sqlFormatter->asDate($this->date_end);

        }

        if(empty($this->date_end) || $this->date_end < $this->date_start) {
            $this->date_end = $this->date_start;
        }

        return parent::beforeValidate();
    }


    function rules() {
        return array_merge([
            ['user_id', 'default', 'value' => \Yii::$app->session->get('__id')],
            ['title', 'string', 'min' => 2, 'max' => 150],
            ['date_start', 'date', 'format' => 'php: Y-m-d'],
            ['date_end', 'date', 'format' => 'php: Y-m-d'],
            ['description', 'string'],
            [['title', 'date_start'], 'required'],
            ['email', 'email'],
            [['image'], 'file', 'extensions' => 'png, jpg'/*, 'maxFiles' => 4*/],
            ['confirmed', 'boolean']
        ], parent::rules());
    }


    public function loadFile() {
        /* @var UploadedFile Image **/
        $this->image = UploadedFile::getInstance($this, 'image');
    }

    public function findByDay($date_start) {
        //=> , ?
        return parent::find()->andWhere(['date_start' => $date_start]);
    }


}