<?php

namespace app\controllers;

use Yii;
use app\models\Client;
use app\models\CatMenu;
use yii\web\Controller;
use app\models\UserOwner;
use app\models\Utilities;
use yii\web\UploadedFile;
use app\models\Restaurant;
use app\models\UserCustom;
use app\models\CatMenuItem;
use yii\filters\VerbFilter;
use app\models\CatMenuItemSearch;
use yii\web\NotFoundHttpException;
use webvimark\modules\UserManagement\models\User;

/**
 * CatMenuItemController implements the CRUD actions for CatMenuItem model.
 */
class CatMenuItemController extends Controller
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
        $searchModel = new CatMenuItemSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $cat_menu_item = $this->findModel($id);
        if (User::hasRole('owner', false)) {
            $id_restaurant = Yii::$app->getRequest()->getCookies()->getValue('id_restaurant');
            if ($cat_menu_item->catmeniteFkcatmenu->catmen_fkrestaurant == $id_restaurant) {
                $restaurant = Restaurant::getRestaurant($id_restaurant);
                return $this->render('owner-view', compact('cat_menu_item', 'restaurant'));
            } else {
                Yii::$app->session->setFlash('error', 'Selecciona una resturante para acceder a más opciones.');
                return $this->redirect(['/']);
            }
        }
    }

    public function actionCreate()
    {
        $cat_menu_item = new CatMenuItem();
        if (User::hasRole('owner', false)) {
            $id_restaurant = Yii::$app->getRequest()->getCookies()->getValue('id_restaurant');
            if ($id_restaurant != null) {
                $restaurant = Restaurant::getRestaurant($id_restaurant);
                if ($this->request->isPost) {
                    if ($cat_menu_item->load($this->request->post())) {
                        $cat_menu_item->state = 1;
                        $img = UploadedFile::getInstance($cat_menu_item, 'img');
                        if (!empty($img)) {
                            $response = Utilities::uploadImage('/upload/images/cat-menu-item/', $img);
                            if (!empty($response)) {
                                $cat_menu_item->catmenite_image = $response;
                            } else {
                                Yii::$app->getSession()->setFlash('Se ha creado el platillo, pero no se subio la imagen, pruebe editandolo más tarde.');
                            }
                        }
                        if ($cat_menu_item->save()) {
                            return $this->redirect(['view', 'id' => $cat_menu_item->id]);
                        }
                    }
                } else {
                    $cat_menu_item->loadDefaultValues();
                }

                return $this->render('owner-create', compact('cat_menu_item', 'restaurant'));
            } else {
                Yii::$app->session->setFlash('error', 'Selecciona una resturante para acceder a más opciones.');
                return $this->redirect(['/']);
            }
        }
    }

    public function actionUpdate($id)
    {
        $cat_menu_item = $this->findModel($id);

        if (User::hasRole('owner', false)) {
            $id_restaurant = Yii::$app->getRequest()->getCookies()->getValue('id_restaurant');
            if ($cat_menu_item->catmeniteFkcatmenu->catmen_fkrestaurant == $id_restaurant) {
                $restaurant = Restaurant::getRestaurant($id_restaurant);
                if ($this->request->isPost && $cat_menu_item->load($this->request->post())) {
                    $img = UploadedFile::getInstance($cat_menu_item, 'img');
                    if (!empty($img)) {
                        $response = Utilities::uploadImage('/upload/images/cat-menu-item/', $img);
                        if (!empty($response)) {
                            if (!empty($cat_menu_item->catmenite_image)) {
                                unlink(Yii::$app->basePath . "/web" . $cat_menu_item->catmenite_image);
                            }
                            $cat_menu_item->catmenite_image = $response;
                        } else {
                            Yii::$app->getSession()->setFlash('Se ha creado el platillo, pero no se subio la imagen, pruebe editandolo más tarde.');
                        }
                    }
                    if ($cat_menu_item->save()) {
                        return $this->redirect(['view', 'id' => $cat_menu_item->id]);
                    }
                }

                return $this->render('owner-update', compact('restaurant', 'cat_menu_item'));
            } else {
                Yii::$app->session->setFlash('error', 'Selecciona uno de tus resturantes para acceder a más opciones.');
                return $this->redirect(['/']);
            }
        }
    }

    public function actionDelete($id)
    {
        $cat_menu_item = $this->findModel($id);
        $cat_menu_item->state = 0;
        if ($cat_menu_item->save()) {
            Yii::$app->session->setFlash('success', 'El platillo se ha elimando correctamente.');
        } else {
            Yii::$app->session->setFlash('error', 'No se ha podido eliminar el platillo, intente más tarde.');
        }
        return $this->redirect(['platillos']);
    }

    public function actionPlatillos()
    {
        if (User::hasRole('owner', false)) {
            $id_restaurant = Yii::$app->getRequest()->getCookies()->getValue('id_restaurant');
            if ($id_restaurant != null) {
                $restaurant = Restaurant::getRestaurant($id_restaurant);
                $categories = $restaurant->catMenus;
                return $this->render('owner-allPlatillos', compact('categories', 'restaurant'));
            } else {
                Yii::$app->session->setFlash('error', 'Selecciona uno de tus resturantes para acceder a más opciones.');
                return $this->redirect(['/']);
            }
        }
        if (User::hasRole('restaurant_client', false)) {
            $restaurant = Client::getClientLogged()->cliFkrestaurant;
            $categories = $restaurant->catMenus;
            return $this->render('client-allPlatillos', compact('categories', 'restaurant'));
        }
    }

    protected function findModel($id)
    {
        if (($model = CatMenuItem::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
