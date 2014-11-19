<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "publicacao".
 *
 * @property string $titulo
 * @property string $local
 * @property string $ano
 * @property integer $PagInicial
 * @property integer $PagFinal
 * @property string $link
 * @property string $dataExata
 * @property string $tipo
 * @property integer $HistoricoPeriodico_Peri贸dico_issn
 * @property integer $HistoricoPeriodico_fasciculo
 * @property integer $HistoricoPeriodico_volume
 * @property string $HistoricoPeriodico_mes
 * @property string $HistoricoConferencia_anoEvento
 * @property integer $HistoricoConferencia_numEvento
 * @property integer $idPublicacao
 * @property integer $capituloLivro
 * @property integer $edi莽玫esLivro
 *
 * @property Correcao $correcao
 * @property Historicoperiodico $historicoPeriodicoPeri贸dicoIssn
 * @property Historicoconferencia $historicoConferenciaAnoEvento
 * @property PublicacaoHasAreadepesquisa[] $publicacaoHasAreadepesquisas
 * @property Areadepesquisa[] $areaDePesquisaCodAreaPesquisas
 * @property PublicacaoHasGrupo[] $publicacaoHasGrupos
 * @property Grupo[] $grupoGrupos
 * @property PublicacaoHasPublicador[] $publicacaoHasPublicadors
 * @property Publicador[] $publicadorIdPublicadors
 * @property PublicacaoHasReferencias[] $publicacaoHasReferencias
 */
class Publicacao extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'publicacao';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['titulo', 'local', 'ano'], 'required'],
            [['ano', 'dataExata', 'HistoricoPeriodico_mes', 'HistoricoConferencia_anoEvento'], 'safe'],
            [['PagInicial', 'PagFinal', 'HistoricoPeriodico_Peri贸dico_issn', 'HistoricoPeriodico_fasciculo', 'HistoricoPeriodico_volume', 'HistoricoConferencia_numEvento', 'capituloLivro', 'edi莽玫esLivro'], 'integer'],
            [['titulo'], 'string', 'max' => 75],
            [['local', 'tipo'], 'string', 'max' => 45],
            [['link'], 'string', 'max' => 140],
            [['titulo'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'titulo' => 'Titulo',
            'local' => 'Local',
            'ano' => 'Ano',
            'PagInicial' => 'Pag Inicial',
            'PagFinal' => 'Pag Final',
            'link' => 'Link',
            'dataExata' => 'Data Exata',
            'tipo' => 'Tipo',
            'HistoricoPeriodico_Peri贸dico_issn' => 'Historico Periodico  Peri愠dico Issn',
            'HistoricoPeriodico_fasciculo' => 'Historico Periodico Fasciculo',
            'HistoricoPeriodico_volume' => 'Historico Periodico Volume',
            'HistoricoPeriodico_mes' => 'Historico Periodico Mes',
            'HistoricoConferencia_anoEvento' => 'Historico Conferencia Ano Evento',
            'HistoricoConferencia_numEvento' => 'Historico Conferencia Num Evento',
            'idPublicacao' => 'Id Publicacao',
            'capituloLivro' => 'Capitulo Livro',
            'edi莽玫esLivro' => 'Edi悃愕es Livro',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCorrecao()
    {
        return $this->hasOne(Correcao::className(), ['Publicacao_idPublicacao' => 'idPublicacao']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHistoricoPeriodicoPeri贸dicoIssn()
    {
        return $this->hasOne(Historicoperiodico::className(), ['Periodico_issn' => 'HistoricoPeriodico_Peri贸dico_issn', 'fasciculo' => 'HistoricoPeriodico_fasciculo', 'volume' => 'HistoricoPeriodico_volume', 'mes' => 'HistoricoPeriodico_mes']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHistoricoConferenciaAnoEvento()
    {
        return $this->hasOne(Historicoconferencia::className(), ['anoEvento' => 'HistoricoConferencia_anoEvento', 'numEvento' => 'HistoricoConferencia_numEvento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublicacaoHasAreadepesquisas()
    {
        return $this->hasMany(PublicacaoHasAreadepesquisa::className(), ['Publicacao_idPublicacao' => 'idPublicacao']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAreaDePesquisaCodAreaPesquisas()
    {
        return $this->hasMany(Areadepesquisa::className(), ['codAreaPesquisa' => 'AreaDePesquisa_codAreaPesquisa'])->viaTable('publicacao_has_areadepesquisa', ['Publicacao_idPublicacao' => 'idPublicacao']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublicacaoHasGrupos()
    {
        return $this->hasMany(PublicacaoHasGrupo::className(), ['Publicacao_idPublicacao' => 'idPublicacao']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrupoGrupos()
    {
        return $this->hasMany(Grupo::className(), ['Grupo' => 'Grupo_Grupo'])->viaTable('publicacao_has_grupo', ['Publicacao_idPublicacao' => 'idPublicacao']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublicacaoHasPublicadors()
    {
        return $this->hasMany(PublicacaoHasPublicador::className(), ['Publicacao_idPublicacao' => 'idPublicacao']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublicadorIdPublicadors()
    {
        return $this->hasMany(Publicador::className(), ['idPublicador' => 'Publicador_idPublicador'])->viaTable('publicacao_has_publicador', ['Publicacao_idPublicacao' => 'idPublicacao']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublicacaoHasReferencias()
    {
        return $this->hasMany(PublicacaoHasReferencias::className(), ['Publicacao_referencia' => 'idPublicacao']);
    }
}
