<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SeEncargado;

/**
 * SeEncargadoSearch represents the model behind the search form of `app\models\SeEncargado`.
 */
class SeEncargadoSearch extends SeEncargado
{
    public $municipio;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['enc_id', 'enc_fkmunicipio', 'enc_fktipoencargado', 'enc_fkuser'], 'integer'],
            [['enc_nombre', 'enc_paterno', 'enc_materno', 'enc_sexo', 'enc_domicilio', 'municipio'], 'safe'],
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
        $query = SeEncargado::find()->joinWith(['encFkmunicipio','encFkmunicipio.catNacional.nacFkestado']);

        //$query = SeEncargado::find();

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
            'enc_id' => $this->enc_id,
            'enc_fkmunicipio' => $this->enc_fkmunicipio,
            'enc_fktipoencargado' => $this->enc_fktipoencargado,
            'enc_fkuser' => $this->enc_fkuser,
        ]);

        $query->andFilterWhere(['like', 'enc_nombre', $this->enc_nombre])
            ->andFilterWhere(['like', 'enc_paterno', $this->enc_paterno])
            ->andFilterWhere(['like', 'enc_materno', $this->enc_materno])
            ->andFilterWhere(['like', 'enc_sexo', $this->enc_sexo])
            ->andFilterWhere(['like', 'enc_domicilio', $this->enc_domicilio])
            ->andFilterWhere(['like', 'mun_nombre', $this->municipio])
            ->orFilterWhere(['like', 'est_nombre', $this->municipio]);
        return $dataProvider;
    }
}
