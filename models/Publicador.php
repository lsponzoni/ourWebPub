<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Publicador".
 *
 * @property integer $idPublicador
 * @property string $nome
 * @property string $login
 * @property string $senha
 * @property string $endereco
 * @property string $email
 * @property integer $convidadoPor
 *
 * @property Abreviaturas $abreviaturas
 * @property AreaDePesquisaHasPublicador[] $areaDePesquisaHasPublicadors
 * @property AreaDePesquisa[] $areaDePesquisaNomes
 * @property ConvitesValidos[] $convitesValidos
 * @property Grupo[] $grupos
 * @property PublicaPeloGrupo[] $publicaPeloGrupos
 * @property Grupo[] $grupoGrupos
 * @property PublicacaoHasPublicador[] $publicacaoHasPublicadors
 * @property Publicacao[] $publicacaoIdPublicacaos
 * @property Publicador $convidadoPor0
 * @property Publicador[] $publicadors
 * @property TrabalhaEm[] $trabalhaEms
 * @property Instituicao[] $idInstituicaos
 */
class Publicador extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Publicador';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome'], 'required'],
            [['convidadoPor'], 'integer'],
            [['nome'], 'string', 'max' => 75],
            [['login', 'senha', 'endereco', 'email'], 'string', 'max' => 45],
            [['nome'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idPublicador' => 'Id Publicador',
            'nome' => 'Nome',
            'login' => 'Login',
            'senha' => 'Senha',
            'endereco' => 'Endereco',
            'email' => 'Email',
            'convidadoPor' => 'Convidado Por',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAbreviaturas()
    {
        return $this->hasOne(Abreviaturas::className(), ['Publicador_idPublicador' => 'idPublicador']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAreaDePesquisaHasPublicadors()
    {
        return $this->hasMany(AreaDePesquisaHasPublicador::className(), ['Publicador_idPublicador' => 'idPublicador']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAreaDePesquisaNomes()
    {
        return $this->hasMany(AreaDePesquisa::className(), ['nome' => 'AreaDePesquisa_nome'])->viaTable('AreaDePesquisa_has_Publicador', ['Publicador_idPublicador' => 'idPublicador']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConvitesValidos()
    {
        return $this->hasMany(ConvitesValidos::className(), ['Publicador_idPublicador' => 'idPublicador']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrupos()
    {
        return $this->hasMany(Grupo::className(), ['Lider' => 'idPublicador']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublicaPeloGrupos()
    {
        return $this->hasMany(PublicaPeloGrupo::className(), ['Publicador_idPublicador' => 'idPublicador']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrupoGrupos()
    {
        return $this->hasMany(Grupo::className(), ['Grupo' => 'Grupo_Grupo'])->viaTable('PublicaPeloGrupo', ['Publicador_idPublicador' => 'idPublicador']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublicacaoHasPublicadors()
    {
        return $this->hasMany(PublicacaoHasPublicador::className(), ['Publicador_idPublicador' => 'idPublicador']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublicacaoIdPublicacaos()
    {
        return $this->hasMany(Publicacao::className(), ['idPublicacao' => 'Publicacao_idPublicacao'])->viaTable('Publicacao_has_Publicador', ['Publicador_idPublicador' => 'idPublicador']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConvidadoPor0()
    {
        return $this->hasOne(Publicador::className(), ['idPublicador' => 'convidadoPor']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublicadors()
    {
        return $this->hasMany(Publicador::className(), ['convidadoPor' => 'idPublicador']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrabalhaEms()
    {
        return $this->hasMany(TrabalhaEm::className(), ['Publicador_idPublicador' => 'idPublicador']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdInstituicaos()
    {
        return $this->hasMany(Instituicao::className(), ['id' => 'idInstituicao'])->viaTable('TrabalhaEm', ['Publicador_idPublicador' => 'idPublicador']);
    }
}
