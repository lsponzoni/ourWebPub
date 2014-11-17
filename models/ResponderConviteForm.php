<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ResponderConviteForm extends Model
{
    public $token;
    public $email;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['token', 'email'], 'required'],
            [['token', 'email'], 'string', 'max' => 45],
            // email has to be a valid email address
            ['email', 'email']
        ];
    }

    /**
     * Returns a Convite for the specified token, email address.
     * @return a Convite object or null
     */
    public function searchConvite()
    {
        return Convite::findOne(['token' => $this->token, 'email' => $this->email]);
    }
}
