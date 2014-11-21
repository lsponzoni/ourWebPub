<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "publicacao_has_grupo".
 *
 * @property integer $Publicacao_idPublicacao
 * @property integer $Grupo_Grupo
 * @property string $homologa
 *
 * @property Publicacao $publicacaoIdPublicacao
 * @property Grupo $grupoGrupo
 */
class PublicacaoHasGrupo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'publicacao_has_grupo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Publicacao_idPublicacao', 'Grupo_Grupo'], 'required'],
            [['Publicacao_idPublicacao', 'Grupo_Grupo'], 'integer'],
            [['homologa'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Publicacao_idPublicacao' => 'Publicacao Id Publicacao',
            'Grupo_Grupo' => 'Grupo  Grupo',
            'homologa' => 'Homologa',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublicacaoIdPublicacao()
    {
        return $this->hasOne(Publicacao::className(), ['idPublicacao' => 'Publicacao_idPublicacao']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrupoGrupo()
    {
        return $this->hasOne(Grupo::className(), ['Grupo' => 'Grupo_Grupo']);
    }
}
