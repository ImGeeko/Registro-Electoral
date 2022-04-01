<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "se_encargado".
 *
 * @property int $enc_id Id
 * @property string $enc_nombre Nombre
 * @property string $enc_paterno Apellido Paterno
 * @property string $enc_materno Apellido Materno
 * @property string|null $enc_sexo Sexo
 * @property string|null $enc_domicilio Domicilio
 * @property int $enc_fkmunicipio Municipio
 * @property int $enc_fktipoencargado Tipo
 * @property int|null $enc_fkuser User
 *
 * @property CatMunicipio $encFkmunicipio
 * @property CatTipopersonal $encFktipoencargado
 * @property User $encFkuser
 * @property SeResponsable[] $seResponsables
 */
class SeEncargado extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'se_encargado';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['enc_nombre', 'enc_paterno', 'enc_materno', 'enc_fkmunicipio', 'enc_fktipoencargado'], 'required'],
            [['enc_fkmunicipio', 'enc_fktipoencargado', 'enc_fkuser'], 'integer'],
            [['enc_nombre', 'enc_paterno', 'enc_materno', 'enc_domicilio'], 'string', 'max' => 30],
            [['enc_sexo'], 'string', 'max' => 20],
            [['enc_fkmunicipio'], 'exist', 'skipOnError' => true, 'targetClass' => CatMunicipio::className(), 'targetAttribute' => ['enc_fkmunicipio' => 'mun_id']],
            [['enc_fktipoencargado'], 'exist', 'skipOnError' => true, 'targetClass' => CatTipopersonal::className(), 'targetAttribute' => ['enc_fktipoencargado' => 'tipenc_id']],
            [['enc_fkuser'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['enc_fkuser' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'enc_id'              => 'Id',
            'enc_nombre'          => 'Nombre',
            'enc_paterno'         => 'Apellido Paterno',
            'enc_materno'         => 'Apellido Materno',
            'enc_sexo'            => 'Sexo',
            'enc_domicilio'       => 'Domicilio',
            //'enc_fkmunicipio'     => 'Municipio',
            'municipio'           => 'Municipio',
            'enc_fktipoencargado' => 'Tipo',
            'enc_fkuser'          => 'User',
        ];
    }

    /**
     * Gets query for [[EncFkmunicipio]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEncFkmunicipio()
    {
        return $this->hasOne(CatMunicipio::className(), ['mun_id' => 'enc_fkmunicipio']);
    }

    /**
     * Gets query for [[EncFktipoencargado]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEncFktipoencargado()
    {
        return $this->hasOne(CatTipopersonal::className(), ['tipenc_id' => 'enc_fktipoencargado']);
    }

    /**
     * Gets query for [[EncFkuser]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEncFkuser()
    {
        return $this->hasOne(User::className(), ['id' => 'enc_fkuser']);
    }

    /**
     * Gets query for [[SeResponsables]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSeResponsables()
    {
        return $this->hasMany(SeResponsable::className(), ['res_fkpersonal' => 'enc_id']);
    }

    public function getMunicipio()
    {
        return $this->encFkmunicipio->municipioEstado;
    }
}
