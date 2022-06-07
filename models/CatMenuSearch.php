<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CatMenu;

/**
 * CatMenuSearch represents the model behind the search form of `app\models\CatMenu`.
 */
class CatMenuSearch extends CatMenu
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'state', 'catmen_fkrestaurant'], 'integer'],
            [['catmen_name', 'catmen_description', 'catmen_image'], 'safe'],
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
        $query = CatMenu::find();

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
            'catmen_fkrestaurant' => $this->catmen_fkrestaurant,
        ]);

        $query->andFilterWhere(['like', 'catmen_name', $this->catmen_name])
            ->andFilterWhere(['like', 'catmen_description', $this->catmen_description])
            ->andFilterWhere(['like', 'catmen_image', $this->catmen_image]);

        return $dataProvider;
    }
}
