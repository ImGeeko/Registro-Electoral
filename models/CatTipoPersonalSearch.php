<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CatTipoPersonal;

/**
 * CatTipoPersonalSearch represents the model behind the search form of `app\models\CatTipoPersonal`.
 */
class CatTipoPersonalSearch extends CatTipoPersonal
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipenc_id'], 'integer'],
            [['tipenc_nombre'], 'safe'],
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
        $query = CatTipoPersonal::find();

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
            'tipenc_id' => $this->tipenc_id,
        ]);

        $query->andFilterWhere(['like', 'tipenc_nombre', $this->tipenc_nombre]);

        return $dataProvider;
    }
}
