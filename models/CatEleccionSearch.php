<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CatEleccion;

/**
 * CatEleccionSearch represents the model behind the search form of `app\models\CatEleccion`.
 */
class CatEleccionSearch extends CatEleccion
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ele_id'], 'integer'],
            [['ele_nombre', 'ele_anio'], 'safe'],
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
        $query = CatEleccion::find();

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
            'ele_id' => $this->ele_id,
            'ele_anio' => $this->ele_anio,
        ]);

        $query->andFilterWhere(['like', 'ele_nombre', $this->ele_nombre]);

        return $dataProvider;
    }
}
