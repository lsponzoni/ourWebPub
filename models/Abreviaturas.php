<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Abreviaturas".
 *
 * @property string $nome
 * @property integer $Publicador_idPublicador
 *
 * @property Publicador $publicadorIdPublicador
 */
class Abreviaturas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Abreviaturas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Publicador_idPublicador'], 'required'],
            [['Publicador_idPublicador'], 'integer'],
            [['nome'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'nome' => 'Nome',
            'Publicador_idPublicador' => 'Publicador Id Publicador',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublicadorIdPublicador()
    {
        return $this->hasOne(Publicador::className(), ['idPublicador' => 'Publicador_idPublicador']);
    }
}
