<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UserCustom;

/**
 * UserCustomSearch represents the model behind the search form of `app\models\UserCustom`.
 */
class UserCustomSearch extends UserCustom
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'usu_fkgender', 'usu_fkuser'], 'integer'],
            [['usu_nombre', 'usu_paterno', 'usu_materno', 'usu_datebirth', 'usu_photo'], 'safe'],
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
        $query = UserCustom::find();

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
            'usu_datebirth' => $this->usu_datebirth,
            'usu_fkgender' => $this->usu_fkgender,
            'usu_fkuser' => $this->usu_fkuser,
        ]);

        $query->andFilterWhere(['like', 'usu_nombre', $this->usu_nombre])
            ->andFilterWhere(['like', 'usu_paterno', $this->usu_paterno])
            ->andFilterWhere(['like', 'usu_materno', $this->usu_materno])
            ->andFilterWhere(['like', 'usu_photo', $this->usu_photo]);

        return $dataProvider;
    }
}
