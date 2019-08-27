<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "activity".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $date_start
 * @property string $date_end
 * @property int $user_notification
 * @property int $is_blocked
 * @property int $is_repeat
 * @property string $date_created
 * @property int $user_id
 *
 * @property User $user
 */
class ActivityBase extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'activity';
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {

        return [
            [['title', 'date_start', 'user_id'], 'required'],
            [['description'], 'string'],
            [['date_start', 'date_end', 'date_created'], 'safe'],
            [['user_notification', 'is_blocked', 'is_repeat', 'user_id'], 'integer'],
            [['title'], 'string', 'max' => 150],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'date_start' => Yii::t('app', 'Date Start'),
            'date_end' => Yii::t('app', 'Date End'),
            'user_notification' => Yii::t('app', 'User Notification'),
            'is_blocked' => Yii::t('app', 'Is Blocked'),
            'is_repeat' => Yii::t('app', 'Is Repeat'),
            'date_created' => Yii::t('app', 'Date Created'),
            'user_id' => Yii::t('app', 'User ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        //return $this->hasOne(Users::class(), ['id' => 'user_id']);
        return $this->hasOne(Users::class, ['id' => 'user_id']);
    }
}
