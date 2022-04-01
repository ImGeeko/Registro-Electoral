<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cat_eleccion".
 *
 * @property int $ele_id Id
 * @property string $ele_nombre Nombre
 * @property string $ele_anio Año
 *
 * @property SeCandidato[] $seCandidatos
 * @property SeResultado[] $seResultados
 */
class CatEleccion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cat_eleccion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ele_nombre', 'ele_anio'], 'required'],
            [['ele_anio'], 'safe'],
            [['ele_nombre'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ele_id'     => 'Id',
            'ele_nombre' => 'Nombre',
            'ele_anio'   => 'Año',
        ];
    }

    /**
     * Gets query for [[SeCandidatos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSeCandidatos()
    {
        return $this->hasMany(SeCandidato::className(), ['can_fkeleccion' => 'ele_id']);
    }

    /**
     * Gets query for [[SeResultados]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSeResultados()
    {
        return $this->hasMany(SeResultado::className(), ['res_fkeleccion' => 'ele_id']);
    }
}
