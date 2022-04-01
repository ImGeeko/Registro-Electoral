<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "se_responsable".
 *
 * @property int $res_id Id
 * @property int $res_fkcasilla Casilla
 * @property int $res_fkpersonal Personal
 *
 * @property SeCasilla $resFkcasilla
 * @property SeEncargado $resFkpersonal
 */
class SeResponsable extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'se_responsable';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['res_fkcasilla', 'res_fkpersonal'], 'required'],
            [['res_fkcasilla', 'res_fkpersonal'], 'integer'],
            [['res_fkcasilla'], 'exist', 'skipOnError' => true, 'targetClass' => SeCasilla::className(), 'targetAttribute' => ['res_fkcasilla' => 'cas_id']],
            [['res_fkpersonal'], 'exist', 'skipOnError' => true, 'targetClass' => SeEncargado::className(), 'targetAttribute' => ['res_fkpersonal' => 'enc_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'res_id'         => 'Id',
            'res_fkcasilla'  => 'Casilla',
            'res_fkpersonal' => 'Personal',
            'casilla'        => 'Casilla',
            'personal'       => 'Personal',
        ];
    }

    /**
     * Gets query for [[ResFkcasilla]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResFkcasilla()
    {
        return $this->hasOne(SeCasilla::className(), ['cas_id' => 'res_fkcasilla']);
    }

    /**
     * Gets query for [[ResFkpersonal]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResFkpersonal()
    {
        return $this->hasOne(SeEncargado::className(), ['enc_id' => 'res_fkpersonal']);
    }
    public static function map()
    {
        return ArrayHelper::map(self::find()->all(), 'res_id', 'personal');
    }
    public function getPersonal()
    {
        return $this->resFkpersonal->enc_nombre .' '. $this->resFkpersonal->enc_paterno .' '. $this->resFkpersonal->enc_materno;
    }
    public function getCasilla()
    {
        return $this->resFkcasilla->cas_nombre;
    }
}
