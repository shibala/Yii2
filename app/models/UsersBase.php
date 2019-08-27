<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $email
 * @property string $password_hash
 * @property string $token
 * @property string $name
 * @property string $date_created
 *
 * @property Activity[] $activities
 */
class UsersBase extends \yii\db\ActiveRecord
{

    public $username;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }



    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'password_hash'], 'required'],
            [['date_created'], 'safe'],
            [['email', 'token', 'name'], 'string', 'max' => 150],
            [['password_hash'], 'string', 'max' => 300],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'email' => Yii::t('app', 'Email'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'token' => Yii::t('app', 'Token'),
            'name' => Yii::t('app', 'Name'),
            'date_created' => Yii::t('app', 'Date Created'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivities()
    {
        //return $this->hasMany(Activity::class(), ['user_id' => 'id']);
        return $this->hasMany(Activity::class, ['user_id' => 'id']);
    }
}
