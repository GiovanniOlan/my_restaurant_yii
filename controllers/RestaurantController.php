<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\UserOwner;
use app\models\Utilities;
use yii\web\UploadedFile;
use app\models\Restaurant;
use yii\filters\VerbFilter;
use app\models\RestaurantSearch;
use yii\web\NotFoundHttpException;
use webvimark\modules\UserManagement\models\User;

/**
 * RestaurantController implements the CRUD actions for Restaurant model.
 */
class RestaurantController extends Controller
{
    /**
     * @inheritDoc
     */
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
        $searchModel = new RestaurantSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $restaurant = $this->findModel($id);
        if (Yii::$app->user->isSuperAdmin) {
            return $this->render('view', compact('restaurant'));
        }
        if (User::hasRole('owner')) {
            return $this->render('owner-view', compact('restaurant'));
        }
    }

    public function actionCreate()
    {
        $restaurant = new Restaurant();

        if ($this->request->isPost) {
            if ($restaurant->load($this->request->post())) {
                $restaurant->state = 1;
                $restaurant->res_fkuserowner = UserOwner::getUserOwnerLogged()->id;
                $img_mainimage = UploadedFile::getInstance($restaurant, 'img_mainimage');
                if (!empty($img_mainimage)) {
                    $response = Utilities::uploadImage('/upload/images/restaurant/', $img_mainimage);
                    if (!empty($response)) {
                        $restaurant->res_mainimage = $response;
                    } else {
                        Yii::$app->getSession()->setFlash('Se ha creado el restaurante, pero no se subio la imagen Principal, intente más tarde.');
                    }
                }
                $img_logo = UploadedFile::getInstance($restaurant, 'img_logo');
                if (!empty($img_logo)) {
                    $response_second = Utilities::uploadImage('/upload/images/restaurant/', $img_logo);
                    if (!empty($response_second)) {
                        $restaurant->res_logo = $response_second;
                    } else {
                        Yii::$app->getSession()->setFlash('Se ha creado el restaurante, pero no se subio el logo, intente más tarde.');
                    }
                }
                if ($restaurant->save()) {
                    return $this->redirect(['view', 'id' => $restaurant->id]);
                } else {
                    Yii::$app->getSession()->setFlash('No se pudo crear el resturante, intente más tarde.');
                }
            }
        } else {
            $restaurant->loadDefaultValues();
        }

        if (User::hasRole('owner')) {
            return $this->render('owner-create', compact('restaurant'));
        } else {
            return $this->render('create', 'restaurant');
        }
    }

    public function actionUpdate($id)
    {
        $restaurant = $this->findModel($id);

        if ($this->request->isPost && $restaurant->load($this->request->post())) {
            $img_mainimage = UploadedFile::getInstance($restaurant, 'img_mainimage');
            if (!empty($img_mainimage)) {
                $response = Utilities::uploadImage('/upload/images/restaurant/', $img_mainimage);
                if (!empty($response)) {
                    if (!empty($restaurant->res_mainimage)) {
                        unlink(Yii::$app->basePath . "/web" . $restaurant->res_mainimage);
                    }
                    $restaurant->res_mainimage = $response;
                } else {
                    Yii::$app->getSession()->setFlash('Se ha creado el restaurante, pero no se subio la imagen Principal, intente más tarde.');
                }
            }
            $img_logo = UploadedFile::getInstance($restaurant, 'img_logo');
            if (!empty($img_logo)) {
                $response_second = Utilities::uploadImage('/upload/images/restaurant/', $img_logo);
                if (!empty($response_second)) {
                    if (!empty($restaurant->res_logo)) {
                        unlink(Yii::$app->basePath . "/web" . $restaurant->res_logo);
                    }
                    $restaurant->res_logo = $response_second;
                } else {
                    Yii::$app->getSession()->setFlash('Se ha creado el restaurante, pero no se subio el logo, intente más tarde.');
                }
            }

            if ($restaurant->save()) {

                return $this->redirect(['view', 'id' => $restaurant->id]);
            }
        }

        if (User::hasRole('owner')) {
            return $this->render('owner-update', compact('restaurant'));
        } else {
            return $this->render('create', 'restaurant');
        }
    }

    public function actionDelete($id)
    {
        $restaurant = $this->findModel($id);
        $restaurant->state = 0;
        if ($restaurant->save()) {
            Yii::$app->session->setFlash('success', 'Se ha eliminado Correctamente.');
        } else {
            Yii::$app->session->setFlash('error', 'No se ha podido eliminar, intente más tarde');
        }
        return $this->redirect(['/site/index']);
    }

    protected function findModel($id)
    {
        if (($model = Restaurant::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
