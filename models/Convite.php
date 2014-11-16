<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ConvitesValidos".
 *
 * @property string $token
 * @property string $email
 * @property integer $Publicador_idPublicador
 * @property string $expiraEm
 *
 * @property Publicador $publicadorIdPublicador
 */
class Convite extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ConvitesValidos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['token', 'email'], 'required'],
            [['Publicador_idPublicador'], 'integer'],
            [['expiraEm'], 'safe'],
            [['token', 'email'], 'string', 'max' => 45],
            [['token'], 'unique'],
            ['email', 'email']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'token' => 'Token',
            'email' => 'Email',
            'Publicador_idPublicador' => 'Publicador Id Publicador',
            'expiraEm' => 'Expira Em',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublicadorIdPublicador()
    {
        return $this->hasOne(Publicador::className(), ['idPublicador' => 'Publicador_idPublicador']);
    }


    public function send($ourEmail, $message)
    {
        $this->token = Yii::$app->getSecurity()->generateRandomString();
        $this->expiraEm = date('y-m-d h:i:s', strtotime("+1 month"));
        
        $defaultSubject = "Convite Para Cadastro";
        if ($this->validate()) {
            Yii::$app->mailer->compose()
                ->setTo($this->email)
                ->setFrom([$ourEmail])
                ->setSubject($defaultSubject)
                ->setTextBody(sprintf($message, $this->token, $this->expiraEm))
                ->send();
            return $this->save();
        } else {
            return false;
        }
    }
}
