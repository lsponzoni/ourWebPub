<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "areadepesquisa_has_publicador".
 *
 * @property string $AreaDePesquisa_nome
 * @property integer $Publicador_idPublicador
 *
 * @property Areadepesquisa $areaDePesquisaNome
 * @property Publicador $publicadorIdPublicador
 */
class AreadepesquisaHasPublicador extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'areadepesquisa_has_publicador';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['AreaDePesquisa_nome', 'Publicador_idPublicador'], 'required'],
            [['Publicador_idPublicador'], 'integer'],
            [['AreaDePesquisa_nome'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'AreaDePesquisa_nome' => 'Area De Pesquisa Nome',
            'Publicador_idPublicador' => 'Publicador Id Publicador',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAreaDePesquisaNome()
    {
        return $this->hasOne(Areadepesquisa::className(), ['nome' => 'AreaDePesquisa_nome']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublicadorIdPublicador()
    {
        return $this->hasOne(Publicador::className(), ['idPublicador' => 'Publicador_idPublicador']);
    }
}
