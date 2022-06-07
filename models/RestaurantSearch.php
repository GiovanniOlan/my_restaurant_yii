<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Restaurant;

/**
 * RestaurantSearch represents the model behind the search form of `app\models\Restaurant`.
 */
class RestaurantSearch extends Restaurant
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'state', 'res_fkuserowner'], 'integer'],
            [['res_name', 'res_description', 'res_logo', 'res_slogan', 'res_mainimage'], 'safe'],
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
    public function search($params)
    {
        $query = Restaurant::find();

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

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'state' => $this->state,
            'res_fkuserowner' => $this->res_fkuserowner,
        ]);

        $query->andFilterWhere(['like', 'res_name', $this->res_name])
            ->andFilterWhere(['like', 'res_description', $this->res_description])
            ->andFilterWhere(['like', 'res_logo', $this->res_logo])
            ->andFilterWhere(['like', 'res_slogan', $this->res_slogan])
            ->andFilterWhere(['like', 'res_mainimage', $this->res_mainimage]);

        return $dataProvider;
    }
}
