<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Activity;

/**
 * ActivitySearch represents the model behind the search form of `app\models\Activity`.
 */
class ActivitySearch extends Activity
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_notification', 'is_blocked', 'is_repeat', 'user_id'], 'integer'],
            [['title', 'description', 'date_start', 'date_end', 'date_created'], 'safe'],
            [['user_id'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */



    public function search($params, $filter=[])
    {

        $query = Activity::find()->andFilterWhere($filter);

        //для получения активностей авторизованного пользователя
        if (!\Yii::$app->rbac->canViewEditAll())
        {
            $query = Activity::find()->andFilterWhere($filter)->andWhere(['user_id' => \Yii::$app->session['__id']]);
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }



        $filterParams = [
            'id' => $this->id,
            'date_start' => $this->date_start,
            'date_end' => $this->date_end,
            'user_notification' => $this->user_notification,
            'is_blocked' => $this->is_blocked,
            'is_repeat' => $this->is_repeat,
            'date_created' => $this->date_created,
            'user_id' => $this->user_id
        ];




        // grid filtering conditions
        $query->andFilterWhere($filterParams);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }


    /**
     * Список событий на текущий день
     * @return Activity[]|array|\yii\db\ActiveRecord[]
     */
    public function getActivitiesToday()
    {
        $activities = Activity::find()
            ->andWhere('date_start >= :date', [':date' => date('Y-m-d')])
            ->andWhere(['user_notification' => 1])
            ->all();

        return $activities;
    }
}
