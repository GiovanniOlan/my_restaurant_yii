<?php

namespace app\controllers;

use Yii;
use app\models\Client;
use yii\web\Controller;
use app\models\Utilities;
use yii\web\UploadedFile;
use app\models\UserCustom;
use yii\filters\VerbFilter;
use app\models\ClientSearch;
use yii\web\NotFoundHttpException;
use webvimark\modules\UserManagement\models\User;


class ClientController extends Controller
{

    public $freeAccessActions = ['register'];


    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
                'ghost-access' => [
                    'class' => 'webvimark\modules\UserManagement\components\GhostAccessControl',
                ],
            ]
        );
    }

    public function actionIndex()
    {
        $searchModel = new ClientSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new Client();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionRegister()
    {

        $client = new Client;
        $user = new User;
        $user_custom = new UserCustom;

        if ($this->request->isPost) {
            if ($client->load($this->request->post()) && $user->load($this->request->post()) &&  $user_custom->load($this->request->post())) {
                $user->auth_key        = Yii::$app->security->generateRandomString();
                $user->password_hash   = Yii::$app->security->generatePasswordHash($user->password);
                $user->status          = 1;
                $user->created_at      = time();
                $user->updated_at      = time();
                $user->email_confirmed = 1;
                if ($user->save()) {
                    User::assignRole($user->id, "restaurant_client");
                    $user_custom->usu_fkuser = $user->id;
                    $img = UploadedFile::getInstance($user_custom, 'img');
                    if (!empty($img)) {
                        $response = Utilities::uploadImage('/upload/images/user-custom/', $img);
                        if (!empty($response)) {
                            $user_custom->usu_photo = $response;
                        } else {
                            Yii::$app->session->setFlash('Te has registrado, pero no se subio la imagen, pruebe editando tu informacion.');
                        }
                    }
                    if ($user_custom->save()) {
                        $client->cli_fkusercustom = $user_custom->id;
                        $client->state = 1;
                        if ($client->save()) {
                            return $this->redirect(['/']);
                        }
                        $user_custom->delete();
                    }
                    $user->delete();
                }
                Yii::$app->session->setFlash('Error', 'No se guardar tu usuario, intentelo mas tarde');
            }
        } else {
            $client->loadDefaultValues();
        }
        return $this->render('register', compact('client', 'user', 'user_custom'));
    }

    protected function findModel($id)
    {
        if (($model = Client::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
