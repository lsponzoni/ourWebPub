<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "grupo".
 *
 * @property integer $Grupo
 * @property integer $Lider
 * @property string $nome
 * @property integer $cadastroOficial
 *
 * @property AreadepesquisaHasGrupo[] $areadepesquisaHasGrupos
 * @property Areadepesquisa[] $areaDePesquisaCodAreaPesquisas
 * @property Publicador $lider
 * @property PublicacaoHasGrupo[] $publicacaoHasGrupos
 * @property Publicacao[] $publicacaoIdPublicacaos
 * @property Publicapelogrupo[] $publicapelogrupos
 * @property Publicador[] $publicadorIdPublicadors
 */
class Grupo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'grupo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Lider', 'nome', 'cadastroOficial'], 'required'],
            [['Lider', 'cadastroOficial'], 'integer'],
            [['nome'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Grupo' => 'Grupo',
            'Lider' => 'Lider',
            'nome' => 'Nome',
            'cadastroOficial' => 'Cadastro Oficial',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAreadepesquisaHasGrupos()
    {
        return $this->hasMany(AreadepesquisaHasGrupo::className(), ['Grupo_Grupo' => 'Grupo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAreaDePesquisaCodAreaPesquisas()
    {
        return $this->hasMany(Areadepesquisa::className(), ['codAreaPesquisa' => 'AreaDePesquisa_codAreaPesquisa'])->viaTable('areadepesquisa_has_grupo', ['Grupo_Grupo' => 'Grupo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLider()
    {
        return $this->hasOne(Publicador::className(), ['idPublicador' => 'Lider']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublicacaoHasGrupos()
    {
        return $this->hasMany(PublicacaoHasGrupo::className(), ['Grupo_Grupo' => 'Grupo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublicacaoIdPublicacaos()
    {
        return $this->hasMany(Publicacao::className(), ['idPublicacao' => 'Publicacao_idPublicacao'])->viaTable('publicacao_has_grupo', ['Grupo_Grupo' => 'Grupo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublicapelogrupos()
    {
        return $this->hasMany(Publicapelogrupo::className(), ['Grupo_Grupo' => 'Grupo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublicadorIdPublicadors()
    {
        return $this->hasMany(Publicador::className(), ['idPublicador' => 'Publicador_idPublicador'])->viaTable('publicapelogrupo', ['Grupo_Grupo' => 'Grupo']);
    }
}
