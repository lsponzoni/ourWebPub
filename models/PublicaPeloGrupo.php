<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "publicapelogrupo".
 *
 * @property integer $Grupo_Grupo
 * @property integer $Publicador_idPublicador
 *
 * @property Grupo $grupoGrupo
 * @property Publicador $publicadorIdPublicador
 */
class PublicaPeloGrupo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'publicapelogrupo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Grupo_Grupo', 'Publicador_idPublicador'], 'required'],
            [['Grupo_Grupo', 'Publicador_idPublicador'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Grupo_Grupo' => 'Grupo  Grupo',
            'Publicador_idPublicador' => 'Publicador Id Publicador',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrupoGrupo()
    {
        return $this->hasOne(Grupo::className(), ['Grupo' => 'Grupo_Grupo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublicadorIdPublicador()
    {
        return $this->hasOne(Publicador::className(), ['idPublicador' => 'Publicador_idPublicador']);
    }
}
