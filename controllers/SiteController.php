<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\bootstrap4\ActiveForm;
use yii\filters\AccessControl;
use webvimark\modules\UserManagement\models\User;
use webvimark\modules\UserManagement\models\forms\LoginForm;

class SiteController extends Controller
{

    //public $freeAccessActions = ['index'];

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

    /**
     * {@inheritdoc}
     */
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

        if (User::hasRole('owner', false)) {
            return $this->render('owner/index');
        }
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/site/login']);
        }
        // if (User::hasRole('restaurant_empleado', false)) {
        //     return $this->redirect(['/'])
        // }
        if (User::hasRole('restaurant_client', false)) {
            return $this->redirect(['/cat-menu-item/platillos']);
        }
        if (User::hasRole('restaurant_empleado', false)) {
            return $this->redirect(['/empleado']);
        }
    }

    public function actionLogin()
    {
        $this->view->title = 'Login';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if (Yii::$app->request->isAjax and $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post()) and $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', compact('model'));
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        // $model = new ContactForm();
        // if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
        //     Yii::$app->session->setFlash('contactFormSubmitted');

        //     return $this->refresh();
        // }
        // return $this->render('contact', [
        //     'model' => $model,
        // ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
