<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "areadepesquisa".
 *
 * @property string $nome
 * @property integer $codAreaPesquisa
 *
 * @property AreadepesquisaHasGrupo[] $areadepesquisaHasGrupos
 * @property Grupo[] $grupoGrupos
 * @property AreadepesquisaHasPublicador[] $areadepesquisaHasPublicadors
 * @property Publicador[] $publicadorIdPublicadors
 * @property PublicacaoHasAreadepesquisa[] $publicacaoHasAreadepesquisas
 * @property Publicacao[] $publicacaoIdPublicacaos
 */
class Areadepesquisa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'areadepesquisa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome'], 'required'],
            [['nome'], 'string', 'max' => 45],
            [['nome'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'nome' => 'Nome',
            'codAreaPesquisa' => 'Cod Area Pesquisa',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAreadepesquisaHasGrupos()
    {
        return $this->hasMany(AreadepesquisaHasGrupo::className(), ['AreaDePesquisa_codAreaPesquisa' => 'codAreaPesquisa']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrupoGrupos()
    {
        return $this->hasMany(Grupo::className(), ['Grupo' => 'Grupo_Grupo'])->viaTable('areadepesquisa_has_grupo', ['AreaDePesquisa_codAreaPesquisa' => 'codAreaPesquisa']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAreadepesquisaHasPublicadors()
    {
        return $this->hasMany(AreadepesquisaHasPublicador::className(), ['AreaDePesquisa_nome' => 'nome']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublicadorIdPublicadors()
    {
        return $this->hasMany(Publicador::className(), ['idPublicador' => 'Publicador_idPublicador'])->viaTable('areadepesquisa_has_publicador', ['AreaDePesquisa_nome' => 'nome']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublicacaoHasAreadepesquisas()
    {
        return $this->hasMany(PublicacaoHasAreadepesquisa::className(), ['AreaDePesquisa_codAreaPesquisa' => 'codAreaPesquisa']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublicacaoIdPublicacaos()
    {
        return $this->hasMany(Publicacao::className(), ['idPublicacao' => 'Publicacao_idPublicacao'])->viaTable('publicacao_has_areadepesquisa', ['AreaDePesquisa_codAreaPesquisa' => 'codAreaPesquisa']);
    }
}
