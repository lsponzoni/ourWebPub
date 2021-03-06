<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ConviteForm is the model behind the Invite form.
 */
class ConviteForm extends Model 
{
	public $email;
	public $message; 

	private $template = "%s convida ao OurWebPub." ;
    private $tokenLine = "<br>Acesse o site <br>\n Com o token: <br>\r\n%s\r\n<br>\n Ate %s <br>\n Para efetuar o cadastro.<br>" ;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['email'], 'required'],
            [['message'], 'string', 'max' => 140],

            // email has to be a valid email address
            ['email', 'email']
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param  string  $email the target email address
     * @return boolean whether the model passes validation
     */
    public function getMessage()
    {
        return $this->message . $this->tokenLine;
    }

    /**
     * Change the template message at this model using a name.
     * @param  string  $email the target email address
     * @return boolean whether the model passes validation
     */
    public function templateMessage($name)
    {
    	$this->message = sprintf($this->template, $name);
    }
}
