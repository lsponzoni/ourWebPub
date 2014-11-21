<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "publicacao_has_referencias".
 *
 * @property integer $Publicacao_idPublicacao
 * @property integer $Publicacao_referencia
 * @property string $descricaoRef
 *
 * @property Publicacao $publicacaoIdPublicacao
 * @property Publicacao $publicacaoReferencia
 */
class PublicacaoHasReferencias extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'publicacao_has_referencias';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Publicacao_idPublicacao'], 'required'],
            [['Publicacao_idPublicacao', 'Publicacao_referencia'], 'integer'],
            [['descricaoRef'], 'string', 'max' => 140]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Publicacao_idPublicacao' => 'Publicacao Id Publicacao',
            'Publicacao_referencia' => 'Publicacao Referencia',
            'descricaoRef' => 'Descricao Ref',
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
    public function getPublicacaoReferencia()
    {
        return $this->hasOne(Publicacao::className(), ['idPublicacao' => 'Publicacao_referencia']);
    }
}
