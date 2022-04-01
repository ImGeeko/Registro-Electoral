<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cat_tipopersonal".
 *
 * @property int $tipenc_id Id
 * @property string $tipenc_nombre Nombre
 *
 * @property SeEncargado[] $seEncargados
 */
class CatTipoPersonal extends \yii\db\ActiveRecord
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
            'tipenc_id'     => 'Id',
            'tipenc_nombre' => 'Nombre',
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
}
