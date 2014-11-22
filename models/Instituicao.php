<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "instituicao".
 *
 * @property integer $id
 * @property string $nome
 * @property string $pais
 *
 * @property Trabalhaem[] $trabalhaems
 * @property Publicador[] $publicadorIdPublicadors
 */
class Instituicao extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'instituicao';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome'], 'required'],
            [['nome'], 'string', 'max' => 45],
            [['pais'], 'string', 'max' => 2],
            [['nome'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'pais' => 'Pais',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrabalhaems()
    {
        return $this->hasMany(Trabalhaem::className(), ['idInstituicao' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublicadorIdPublicadors()
    {
        return $this->hasMany(Publicador::className(), ['idPublicador' => 'Publicador_idPublicador'])->viaTable('trabalhaem', ['idInstituicao' => 'id']);
    }
}
