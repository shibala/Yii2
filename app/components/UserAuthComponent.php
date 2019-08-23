<?php
/**
 * Created by PhpStorm.
 */

namespace app\components;


use app\models\Users;
use yii\base\Component;

class UserAuthComponent extends Component
{

    /**
     * @param null $params
     * @return Users
     */
    public function getModel($params=null) {

        /** @var Users $model */
        $model = new Users();

        if ($params) {
            $model->load($params);
        }

        return $model;
    }

    public function createNewUser(&$model):bool {

        if (!$model->validate(['email', 'password', 'password_repeat'])) {
            return false;
        }

        $model->password_hash = $this->hashPassword($model->password);

        $transaction = \Yii::$app->db->beginTransaction();
        try {
            $model->save();
            \Yii::$app->rbac->addRole($model->id);

            $transaction->commit();

            return true;
        }
        catch (\Throwable $e) {
            $transaction->rollBack();
        }

        /*if ($model->save()) {

            \Yii::$app->rbac->addRole($model->id);

            return true;
        }*/

    }

    private function hashPassword($password) {
        return \Yii::$app->security->generatePasswordHash($password);
    }

    public function loginUser(&$model):bool {

        $user = $this->getUserByEmail($model->email);

        if (!$user) {
            $model->addError('email', 'Пользователь с email '.$model->email.' не зарегистрирован');
            return false;
        }

        if (!$this->validatePassword($model->password, $user->password_hash)) {
            $model->addError('password', 'Неверный пароль!');
            return false;
        }

        $user->username = $user->email;

        return \Yii::$app->user->login($user);

    }

    public function getUserByEmail($email) {
        return $this->getModel()::find()->andWhere(['email' => $email])->one();
    }

    public function validatePassword($password, $hash) {
        return \Yii::$app->security->validatePassword($password, $hash);
    }

}