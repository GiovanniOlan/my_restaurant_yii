<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Empleado;

/**
 * EmpleadoSearch represents the model behind the search form of `app\models\Empleado`.
 */
class EmpleadoSearch extends Empleado
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'state', 'emp_fkrestaurant', 'emp_fkusercustom'], 'integer'],
            [['emp_description', 'emp_curp', 'emp_rfc'], 'safe'],
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
        $query = Empleado::find();

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
            'emp_fkrestaurant' => $this->emp_fkrestaurant,
            'emp_fkusercustom' => $this->emp_fkusercustom,
        ]);

        $query->andFilterWhere(['like', 'emp_description', $this->emp_description])
            ->andFilterWhere(['like', 'emp_curp', $this->emp_curp])
            ->andFilterWhere(['like', 'emp_rfc', $this->emp_rfc]);

        return $dataProvider;
    }
}
