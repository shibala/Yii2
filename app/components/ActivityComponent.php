<?php
/**
 * Created by PhpStorm.
 */

namespace app\components;

use app\models\Activity;
use yii\base\Component;
use yii\helpers\FileHelper;

class ActivityComponent extends Component
{
    /**@var string class of activity entity*/

    public $activity_class;

    /**@return Activity*/

    public function getModel($params=null) {
        $model = new $this -> activity_class;



        if ($params && is_array($params)) {
            $model -> load($params);
        }


        return $model;
    }

    /** @param $model Activity */

    public function createActivity(&$model){

        $model -> beforeValidate();

        if($model->validate()) {

            if ($model->image) {
                $path = $this->getPathSaveFile();
                $name = mt_rand(0, 9999).time().'.'.$model->image->getExtension();


                if (!$model->image->saveAs($path.$name)) {
                    $model->addError('image', 'не удалось загрузить файл');
                    return false;
                }

                $model->image=$name;

            }

            if ($model->confirmed) {
                $model->save();
            }




            return true;
        }
    }

    private function getPathSaveFile() {
        FileHelper::createDirectory(\Yii::getAlias('@app/web/images'));
        return \Yii::getAlias('@app/web/images/');
    }

    public function getActivity($id) {
        return $this->getModel()::find()->andWhere(['id' => $id])->one();
    }


}