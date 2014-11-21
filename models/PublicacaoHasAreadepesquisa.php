<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "publicacao_has_areadepesquisa".
 *
 * @property integer $Publicacao_idPublicacao
 * @property integer $AreaDePesquisa_codAreaPesquisa
 *
 * @property Publicacao $publicacaoIdPublicacao
 * @property Areadepesquisa $areaDePesquisaCodAreaPesquisa
 */
class PublicacaoHasAreadepesquisa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'publicacao_has_areadepesquisa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Publicacao_idPublicacao', 'AreaDePesquisa_codAreaPesquisa'], 'required'],
            [['Publicacao_idPublicacao', 'AreaDePesquisa_codAreaPesquisa'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Publicacao_idPublicacao' => 'Publicacao Id Publicacao',
            'AreaDePesquisa_codAreaPesquisa' => 'Area De Pesquisa Cod Area Pesquisa',
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
    public function getAreaDePesquisaCodAreaPesquisa()
    {
        return $this->hasOne(Areadepesquisa::className(), ['codAreaPesquisa' => 'AreaDePesquisa_codAreaPesquisa']);
    }
}
