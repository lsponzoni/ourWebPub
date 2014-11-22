<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "trabalhaem".
 *
 * @property integer $Publicador_idPublicador
 * @property integer $idInstituicao
 *
 * @property Publicador $publicadorIdPublicador
 * @property Instituicao $idInstituicao0
 */
class Trabalhaem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'trabalhaem';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Publicador_idPublicador', 'idInstituicao'], 'required'],
            [['Publicador_idPublicador', 'idInstituicao'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Publicador_idPublicador' => 'Publicador Id Publicador',
            'idInstituicao' => 'Id Instituicao',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublicadorIdPublicador()
    {
        return $this->hasOne(Publicador::className(), ['idPublicador' => 'Publicador_idPublicador']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdInstituicao0()
    {
        return $this->hasOne(Instituicao::className(), ['id' => 'idInstituicao']);
    }
}
