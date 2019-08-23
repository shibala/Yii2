<?php
/**
 * Created by PhpStorm.
 */

namespace app\components;


use yii\base\Component;
use yii\db\Query;

class DaoComponent extends Component
{
    public function getDB() {
        return \Yii::$app->db;
    }

    public function getAllUsers() {
        $sql = 'select * from user';
        return $this->getDB()->createCommand($sql)->queryAll();
    }

    public function getUsersActivities($id) {
        $sql = 'select * from activity where user_id = :user_id';
        return $this->getDB()->createCommand($sql, ['user_id' => $id])->queryAll();
    }

    public function getFirstActivity() {
        $sql = 'select * from activity limit 3';
        return $this->getDB()->createCommand($sql)->queryOne();
    }

    public function countNotificatedActivities() {
        $sql = 'select count(id) from activity where user_notification=1';
        return $this->getDB()->createCommand($sql)->queryScalar();
    }

    public function getAllActivitiesOfUser($id){
        $query = new Query();
        return $query->select(['*'])
            ->from('activity a')
            ->innerJoin('user u', 'a.user_id=u.id')
            ->andWhere(['a.user_id' => $id])
            ->orderBy(['a.date_created' => SORT_ASC])
            ->all();
    }
}