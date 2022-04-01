<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "se_casilla".
 *
 * @property int $cas_id Id
 * @property string $cas_nombre Nombre
 * @property string $cas_ubicacion Ubicación
 * @property string|null $cas_gps GPS
 * @property int $cas_fkmunicipio Municipio
 *
 * @property CatMunicipio $casFkmunicipio
 * @property SeResponsable $seResponsable
 * @property SeResultado[] $seResultados
 */
class SeCasilla extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'se_casilla';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cas_nombre', 'cas_ubicacion', 'cas_fkmunicipio'], 'required'],
            [['cas_fkmunicipio'], 'integer'],
            [['cas_nombre', 'cas_ubicacion'], 'string', 'max' => 50],
            [['cas_gps'], 'string', 'max' => 150],
            [['cas_fkmunicipio'], 'exist', 'skipOnError' => true, 'targetClass' => CatMunicipio::className(), 'targetAttribute' => ['cas_fkmunicipio' => 'mun_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cas_id'          => 'Id',
            'cas_nombre'      => 'Nombre',
            'cas_ubicacion'   => 'Ubicación',
            'cas_gps'         => 'GPS',
            'cas_fkmunicipio' => 'Municipio',
            'municipio'       => 'Municipio',
        ];
    }

    /**
     * Gets query for [[CasFkmunicipio]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCasFkmunicipio()
    {
        return $this->hasOne(CatMunicipio::className(), ['mun_id' => 'cas_fkmunicipio']);
    }

    /**
     * Gets query for [[SeResponsables]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSeResponsable()
    {
        return $this->hasOne(SeResponsable::className(), ['res_fkcasilla' => 'cas_id']);
    }

    /**
     * Gets query for [[SeResultados]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSeResultados()
    {
        return $this->hasMany(SeResultado::className(), ['res_fkcasilla' => 'cas_id']);
    }

    public function getMunicipio()
    {
        return $this->casFkmunicipio->municipioEstado;
    }
    public static function map()
    {
        return ArrayHelper::map(self::find()->all(), 'cas_id', 'cas_nombre');
    }
}
