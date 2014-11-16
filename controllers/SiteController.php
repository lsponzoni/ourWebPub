<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

use app\models\ConviteForm;
use app\models\Convite;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && 
                $model->validate() && 
                $model->contact(Yii::$app->params['adminEmail'])) 
        {
            Yii::$app->session->setFlash('contactFormSubmitted');
            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
    
    
    public function actionConvite()
    {
        $conviteForm = new ConviteForm(); 
        $user = Yii::$app->user;
        $nome = SiteController::ehPublicador($user)? $user['nome'] :"Admin"; 
        $conviteForm->templateMessage($nome);

        if($conviteForm->load(Yii::$app->request->post())){
            $convite = new Convite();
            $convite['email'] = $conviteForm['email'];
            if(SiteController::ehPublicador($user)){
                $convite['Publicador_idPublicador'] = $user['idPublicator'];
            }

            $siteMail = Yii::$app->params['adminEmail'];
            $msg  = $conviteForm->getMessage(); 
            if($convite->send($siteMail, $msg)) {
                Yii::$app->session->setFlash('conviteFormSubmitted');                
                return $this->refresh();
            }
        }

        return $this->render('convite', [
                'model' => $conviteForm,
            ]);
    }

    public function actionAcessoPub()
    {
        return $this->render('about');
    }
    
    public static function ehPublicador($user)
    {
        return $user->canGetProperty('idPublicator');
    }
}
