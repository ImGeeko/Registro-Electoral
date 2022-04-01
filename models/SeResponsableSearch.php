<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SeResponsable;

/**
 * SeResponsableSearch represents the model behind the search form of `app\models\SeResponsable`.
 */
class SeResponsableSearch extends SeResponsable
{
    public $personal;
    public $casilla;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['res_id', 'res_fkcasilla', 'res_fkpersonal'], 'integer'],
            [['personal'], 'safe'],
            [['casilla'], 'safe'],
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
        $query = SeResponsable::find()->joinWith(['resFkcasilla','resFkpersonal']);


        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'res_id',
                'res_fkcasilla',
                'personal' => [
                    'asc'  => ['enc_nombre' => SORT_ASC],
                    'desc' => ['enc_nombre' => SORT_DESC],
                    'default' => SORT_ASC,
                ]
            ]
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'res_id',
                'casilla',
                'personal' => [
                    'asc'  => ['cas_nombre' => SORT_ASC],
                    'desc' => ['cas_nombre' => SORT_DESC],
                    'default' => SORT_ASC,
                ]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'res_id' => $this->res_id,
            'res_fkcasilla' => $this->res_fkcasilla,
            'res_fkpersonal' => $this->res_fkpersonal,
        ]);

        $query->andFilterWhere(['like', 'enc_nombre', $this->personal]);   //error en el filtro
        $query->andFilterWhere(['like', 'cas_nombre', $this->casilla]);

        return $dataProvider;
    }
}
