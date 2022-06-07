<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CatMenuItem;

/**
 * CatMenuItemSearch represents the model behind the search form of `app\models\CatMenuItem`.
 */
class CatMenuItemSearch extends CatMenuItem
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'state', 'catmenite_for', 'catmenite_fkcatmenu'], 'integer'],
            [['catmenite_name', 'catmenite_description', 'catmenite_image'], 'safe'],
            [['catmenite_price'], 'number'],
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
        $query = CatMenuItem::find();

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
            'catmenite_for' => $this->catmenite_for,
            'catmenite_price' => $this->catmenite_price,
            'catmenite_fkcatmenu' => $this->catmenite_fkcatmenu,
        ]);

        $query->andFilterWhere(['like', 'catmenite_name', $this->catmenite_name])
            ->andFilterWhere(['like', 'catmenite_description', $this->catmenite_description])
            ->andFilterWhere(['like', 'catmenite_image', $this->catmenite_image]);

        return $dataProvider;
    }
}
