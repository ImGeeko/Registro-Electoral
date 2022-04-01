<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SeCasilla;

/**
 * SeCasillaSearch represents the model behind the search form of `app\models\SeCasilla`.
 */
class SeCasillaSearch extends SeCasilla
{
    public $municipio;
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cas_id', 'cas_fkmunicipio'], 'integer'],
            [['cas_nombre', 'cas_ubicacion', 'cas_gps', 'municipio'], 'safe'],
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
        $query = SeCasilla::find()->joinWith(['casFkmunicipio','casFkmunicipio.catNacional.nacFkestado']);

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
            'cas_id' => $this->cas_id,
            'cas_fkmunicipio' => $this->cas_fkmunicipio,
        ]);

        $query->andFilterWhere(['like', 'cas_nombre', $this->cas_nombre])
            ->andFilterWhere(['like', 'cas_ubicacion', $this->cas_ubicacion])
            ->andFilterWhere(['like', 'cas_gps', $this->cas_gps])
            ->andFilterWhere(['like', 'mun_nombre', $this->municipio])
            ->orFilterWhere(['like', 'est_nombre', $this->municipio]);

        return $dataProvider;
    }
}
