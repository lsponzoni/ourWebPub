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
use app\models\ResponderConviteForm;

use app\models\Publicador;
use app\models\Publicacao;
use app\models\Grupo;
use app\models\PublicaPeloGrupo;
use app\models\PublicacaoHasGrupo;

use yii\data\ActiveDataProvider;


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
        $pub = new ActiveDataProvider([
        'query' => Publicacao::find(),
        'pagination' => [
            'pageSize' => 5,
            ],
        ]);

        $autor = new ActiveDataProvider([
        'query' => Publicador::find(),
        'pagination' => [
            'pageSize' => 5,
            ],
        ]);

        $grupo = new ActiveDataProvider([
        'query' => Grupo::find(),
        'pagination' => [
            'pageSize' => 5,
            ],
        ]);

        return $this->render('index', [
            'dataProviderPublicacao' => $pub,
            'dataProviderAutor' => $autor,
            'dataProviderGrupo' => $grupo
        ]);
    }

    public function actionPublicacoes(){

        $model = new Publicacao();

        $dataProvider = new ActiveDataProvider([
        'query' => Publicacao::find(),
        'pagination' => [
            'pageSize' => 50,
            ],
        ]);

        return $this->render('publicacoes', [
            'dataProvider' => $dataProvider,
            'model' => $model,
            ]);
    }

    public function actionAutores(){
        
        $model = new Publicador();

        $dataProvider = new ActiveDataProvider([
        'query' => Publicador::find(),
        'pagination' => [
            'pageSize' => 50,
            ],
        ]);


        return $this->render('autores', [
            'dataProvider' => $dataProvider,
            'model' => $model,
            ]);
    }

    public function actionGrupos(){
         $model = new Grupo();

        $dataProvider = new ActiveDataProvider([
        'query' => Grupo::find(),
        'sort'=>array(
                'attributes'=>array(
                     'Grupo', 'Lider', 'nome'
                ),
            ),
        'pagination' => [
            'pageSize' => 50,
            ],
        ]);

        // $grupos = Grupo::find()->all();
        // foreach ($grupos as $grupo) 
        // {
        //     $grupo->nomeLider = Publicador::find("idPublicador = :id", array(":id" => $grupo->Lider))->all()[0]->nome;
        // }

        return $this->render('grupos', [
            'dataProvider' => $dataProvider,
            'model' => $model,
            ]);
    }

    public function actionPerfilGrupo($id, $grupo=NULL, $membros = NULL, $publicacoes = NULL){
        if ($grupo == NULL) 
        {
            $grupo = Grupo::find()->where(array('Grupo' => $id))->all()[0];

            $membrosId = PublicaPeloGrupo::find()->where(array('Grupo_Grupo' => $id))->all();
            $membros = array();

            array_push($membros, Publicador::find()->where(array('idPublicador' => $grupo->Lider))->all()[0]);
            foreach ($membrosId as $membro) 
            {
                if($membro->Publicador_idPublicador != $grupo->Lider)
                {
                    array_push($membros, Publicador::find()->where(array('idPublicador' => $membro->Publicador_idPublicador))->all()[0]);
                }

            }
            
            $publicacoesId = PublicacaoHasGrupo::find()->where(array('Grupo_Grupo' => $grupo->Grupo))->all();
            $publicacoes = array();

            foreach ($publicacoesId as $publicacao) 
            {
                array_push($publicacoes, Publicacao::find()->where(array('idPublicacao' => $publicacao->Publicacao_idPublicacao))->all()[0]);                
            }
            
        }

        
        return $this->render('perfil-grupo', [
            'grupo' => $grupo,
            'membros' => $membros,
            'publicacoes' => $publicacoes
            ]);
    }


    public function actionPerfil()
    {
       return $this->render('perfil');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        //var_dump($_POST);

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
            $convite['Publicador_idPublicador'] = (SiteController::ehPublicador($user))? $user['idPublicator'] : NULL;
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


    public function actionResponderConvite()
    {
        $model = new ResponderConviteForm();

        if ($model->load(Yii::$app->request->post())) {
            $convite = $model->searchConvite();
            if (isset($convite)) {
                return $this->redirect([ 'publicador/create',
                    'email' => $convite->getEmail(),
                    'idPub' => $convite->getId()
                ]);
            }
        }

        return $this->render('responder_convite', [
            'model' => $model,
        ]);
    }
    
    public static function ehPublicador($user)
    {
        return $user->canGetProperty('idPublicador');
    }
}
