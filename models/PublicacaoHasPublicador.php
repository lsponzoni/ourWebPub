<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "publicacao_has_publicador".
 *
 * @property integer $Publicacao_idPublicacao
 * @property integer $Publicador_idPublicador
 * @property integer $homologa
 *
 * @property Publicacao $publicacaoIdPublicacao
 * @property Publicador $publicadorIdPublicador
 */
class PublicacaoHasPublicador extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'publicacao_has_publicador';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Publicacao_idPublicacao', 'Publicador_idPublicador'], 'required'],
            [['Publicacao_idPublicacao', 'Publicador_idPublicador', 'homologa'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Publicacao_idPublicacao' => 'Publicacao Id Publicacao',
            'Publicador_idPublicador' => 'Publicador Id Publicador',
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
    public function getPublicadorIdPublicador()
    {
        return $this->hasOne(Publicador::className(), ['idPublicador' => 'Publicador_idPublicador']);
    }
}
