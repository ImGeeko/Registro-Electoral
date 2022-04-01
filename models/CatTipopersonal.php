<?php

namespace app\models;

use yii\helpers\ArrayHelper;


use Yii;

/**
 * This is the model class for table "cat_tipopersonal".
 *
 * @property int $tipenc_id Id
 * @property string $tipenc_nombre Nombre
 *
 * @property SeEncargado[] $seEncargados
 */
class CatTipopersonal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cat_tipopersonal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipenc_nombre'], 'required'],
            [['tipenc_nombre'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'tipenc_id' => 'Id',
            'tipenc_nombre' => 'Nombre',
            'personal'      =>  'Personal',
        ];
    }

    /**
     * Gets query for [[SeEncargados]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSeEncargados()
    {
        return $this->hasMany(SeEncargado::className(), ['enc_fktipoencargado' => 'tipenc_id']);
    }

    public static function map()
    {
        return ArrayHelper::map(CatTipopersonal::find()->all(), 'tipenc_id', 'tipenc_nombre');
    }

    public function getPersonal()
    {
        return $this->encfkpersonal->enc_nombre;
    }
}
