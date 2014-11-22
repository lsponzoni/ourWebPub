<?php

namespace app\models;

class User extends \yii\base\Object implements \yii\web\IdentityInterface
{
    public $id;
    public $username;
    public $password;
    public $authKey;
    public $accessToken;

    private static $users = [
        '100' => [
            'id' => '100',
            'username' => 'admin',
            'password' => 'admin',
            'authKey' => 'test100key',
            'accessToken' => '100-token',
        ],
        '101' => [
            'id' => '101',
            'username' => 'demo',
            'password' => 'demo',
            'authKey' => 'test101key',
            'accessToken' => '101-token',
        ],
    ];

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        $pub = Publicador::find()->where(array('idPublicador' => $id))->one();
        if($pub)
        {
            $user = [
                'id' => $pub->idPublicador,
                'username' => $pub->login,
                'password' => $pub->senha,
                'authKey' =>  $pub->idPublicador,
                'accessToken' => $pub->idPublicador,
            ];
            return new static($user);
        }
        return null;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        
        $pub = Publicador::find('idPublicador = :id', [':id' => $token])->one();
        if($pub)
        {
            $user = [
                'id' => $pub->idPublicador,
                'username' => $pub->login,
                'password' => $pub->senha,
                'authKey' =>  $pub->idPublicador,
                'accessToken' => $pub->idPublicador,
            ];
            return new static($user);
        }
        return null;
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        foreach (self::$users as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }

        $pub = Publicador::find()->where(array('login' => $username))->one();
        if($pub)
        {
            $user = [
                'id' => $pub->idPublicador,
                'username' => $pub->login,
                'password' => $pub->senha,
                'authKey' =>  $pub->idPublicador,
                'accessToken' => $pub->idPublicador,
            ];
            return new static($user);
        }
        return null;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }
}
