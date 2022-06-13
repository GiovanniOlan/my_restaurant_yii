<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\UserOwner;
use app\models\Utilities;
use app\models\UserCustom;
use yii\filters\VerbFilter;
use app\models\UserOwnerSearch;
use yii\web\NotFoundHttpException;
use webvimark\modules\UserManagement\models\User;

class UserOwnerController extends Controller
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
        $searchModel = new UserOwnerSearch();
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
        $model = new UserOwner();

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

        $user = new User;
        $user_custom = new UserCustom;
        $user_owner = new UserOwner;

        if ($this->request->isPost) {
            if ($user->load($this->request->post()) &&  $user_custom->load($this->request->post())) {

                $user->auth_key        = Yii::$app->security->generateRandomString();
                $user->password_hash   = Yii::$app->security->generatePasswordHash($user->password);
                $user->status          = 1;
                $user->created_at      = time();
                $user->updated_at      = time();
                $user->email_confirmed = 1;

                if ($user->save()) {
                    User::assignRole($user->id, "owner");
                    $user_custom->usu_fkuser = $user->id;
                    if (!empty($img)) {
                        $response = Utilities::uploadImage('/upload/images/user-custom/', $img);
                        if (!empty($response)) {
                            $user_custom->usu_photo = $response;
                        } else {
                            Yii::$app->session->setFlash('Te has registrado, pero no se subio la imagen, pruebe editando tu informacion.');
                        }
                    }
                    if ($user_custom->save()) {
                        $user_owner->usu_fkusercustom = $user_custom->id;
                        $user_owner->state = 1;
                        $user_owner->usu_premium = 0;

                        if ($user_owner->save()) {
                            return $this->redirect(['/user-management/auth/login']);
                        }
                        $user_custom->delete();
                    }
                    $user->delete();
                }
                Yii::$app->session->setFlash('Error', 'No se guardar tu usuario, intentelo mas tarde');
                #return $this->render(['register']);
            }
        } else {
            $user_owner->loadDefaultValues();
        }

        return $this->render('register', compact('user', 'user_owner', 'user_custom'));
    }

    protected function findModel($id)
    {
        if (($model = UserOwner::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
