<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "cat_municipio".
 *
 * @property int $mun_id
 * @property string $mun_nombre
 *
 * @property CatNacional[] $catNacionals
 * @property SeCandidato[] $seCandidatos
 * @property SeCasilla[] $seCasillas
 * @property SeEncargado[] $seEncargados
 * @property SePresidentemunicipal[] $sePresidentemunicipals
 * @property SeResultado[] $seResultados
 */
class CatMunicipio extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cat_municipio';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mun_nombre'], 'required'],
            [['mun_nombre'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'mun_id'          => 'Mun ID',
            'mun_nombre'      => 'Mun Nombre',
            'estado'          => 'Estado',
            'municipioEstado' => 'Municipio',
        ];
    }

    /**
     * Gets query for [[CatNacionals]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCatNacional()
    {
        return $this->hasOne(CatNacional::className(), ['nac_fkmunicipio' => 'mun_id']);
    }

    /**
     * Gets query for [[SeCandidatos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSeCandidatos()
    {
        return $this->hasMany(SeCandidato::className(), ['can_fkmunicipio' => 'mun_id']);
    }

    /**
     * Gets query for [[SeCasillas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSeCasillas()
    {
        return $this->hasMany(SeCasilla::className(), ['cas_fkmunicipio' => 'mun_id']);
    }

    /**
     * Gets query for [[SeEncargados]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSeEncargados()
    {
        return $this->hasMany(SeEncargado::className(), ['enc_fkmunicipio' => 'mun_id']);
    }

    /**
     * Gets query for [[SePresidentemunicipals]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSePresidentemunicipals()
    {
        return $this->hasMany(SePresidentemunicipal::className(), ['pre_fkmunicipio' => 'mun_id']);
    }

    /**
     * Gets query for [[SeResultados]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSeResultados()
    {
        return $this->hasMany(SeResultado::className(), ['res_fkmunicipio' => 'mun_id']);
    }

    public function getEstado()
    {
      /*  if($this->mun_id==1972){
            echo '<pre>';
            var_dump($this->catNacional->nacFkestado->est_nombre);
            echo '</pre>';
            die();
        } */
        return $this->catNacional->nacFkestado->est_nombre;
    }

    public function getMunicipioEstado()
    {
        return "{$this->mun_nombre}, {$this->estado}";
    }

    public static function map()
    {
        return ArrayHelper::map(CatMunicipio::find()->all(), 'mun_id', 'municipioEstado');
    }
}
