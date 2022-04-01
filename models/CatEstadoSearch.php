<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CatEstado;

/**
 * CatEstadoSearch represents the model behind the search form of `app\models\CatEstado`.
 */
class CatEstadoSearch extends CatEstado
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['est_id'], 'integer'],
            [['est_nombre'], 'safe'],
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
        $query = CatEstado::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 32],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'est_id' => $this->est_id,
        ]);

        $query->andFilterWhere(['like', 'est_nombre', $this->est_nombre]);

        return $dataProvider;
    }
}
