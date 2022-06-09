<?php

namespace app\controllers;

use Yii;
use yii\db\Query;
use app\models\CatMenu;
use yii\web\Controller;
use app\models\UserOwner;
use app\models\Utilities;
use yii\web\UploadedFile;
use app\models\Restaurant;
use yii\filters\VerbFilter;
use app\models\CatMenuSearch;
use yii\web\NotFoundHttpException;
use webvimark\modules\UserManagement\models\User;

/**
 * CatMenuController implements the CRUD actions for CatMenu model.
 */
class CatMenuController extends Controller
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
        $searchModel = new CatMenuSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $cat_menu = $this->findModel($id);
        if (User::hasRole('owner', false)) {
            $id_restaurant = Yii::$app->getRequest()->getCookies()->getValue('id_restaurant');
            if ($id_restaurant == $cat_menu->catmen_fkrestaurant) {
                $restaurant = Restaurant::getRestaurant($id_restaurant);
                return $this->render('owner-view', compact('cat_menu', 'restaurant'));
            } else {
                Yii::$app->session->setFlash('error', 'La categoria no pertenece a ese restaurante, verifica tus datos.');
                return $this->redirect(['categorias', 'id' => Yii::$app->getRequest()->getCookies()->getValue('id_restaurant')]);
            }
        } else {
            return $this->render('view', compact('cat_menu'));
        }
    }

    public function actionCreate()
    {

        if (User::hasRole('owner', false)) {
            $id_restaurant = Yii::$app->getRequest()->getCookies()->getValue('id_restaurant');
            if ($id_restaurant != null) {
                $cat_menu = new CatMenu();
                $restaurant = Restaurant::getRestaurant($id_restaurant);
                if ($this->request->isPost && $cat_menu->load($this->request->post())) {
                    $cat_menu->state = 1;
                    $cat_menu->catmen_fkrestaurant = $id_restaurant;
                    $img = UploadedFile::getInstance($cat_menu, 'img');
                    if (!empty($img)) {
                        $response = Utilities::uploadImage('/upload/images/cat-menu/', $img);
                        if (!empty($response)) {
                            $cat_menu->catmen_image = $response;
                        } else {
                            Yii::$app->getSession()->setFlash('Se ha creado el restaurante, pero no se subio la imagen, pruebe editando la categoria.');
                        }
                    }
                    if ($cat_menu->save()) {
                        return $this->redirect(['view', 'id' => $cat_menu->id]);
                    } else {
                        Yii::$app->session->setFlash('error', 'No se pudo guardar la categoria, intente más tarde.');
                    }
                } else {
                    $cat_menu->loadDefaultValues();
                }
                return $this->render('owner-create', compact('cat_menu', 'restaurant'));
            } else {
                return $this->redirect(['categorias', 'id' => Yii::$app->getRequest()->getCookies()->getValue('id_restaurant')]);
            }
        }
    }

    public function actionUpdate($id)
    {
        $cat_menu = $this->findModel($id);
        if (User::hasRole('owner', false)) {
            if ($cat_menu->catmen_fkrestaurant == Yii::$app->getRequest()->getCookies()->getValue('id_restaurant')) {
                if ($this->request->isPost && $cat_menu->load($this->request->post())) {
                    $img = UploadedFile::getInstance($cat_menu, 'img');
                    if (!empty($img)) {
                        $response = Utilities::uploadImage('/upload/images/cat-menu/', $img);
                        if (!empty($response)) {
                            if (!empty($cat_menu->catmen_image)) {
                                unlink(Yii::$app->basePath . "/web" . $cat_menu->catmen_image);
                            }
                            $cat_menu->catmen_image = $response;
                        } else {
                            Yii::$app->getSession()->setFlash('Se ha creado el restaurante, pero no se subio la imagen, pruebe editando la categoria.');
                        }
                    }
                    if ($cat_menu->save()) {
                        return $this->redirect(['view', 'id' => $cat_menu->id]);
                    } else {
                        Yii::$app->session->setFlash('error', 'No se pudo guardar la categoria, intente más tarde.');
                    }
                }
                $restaurant = Restaurant::find()->where(['id' => Yii::$app->getRequest()->getCookies()->getValue('id_restaurant')])->one();
                return $this->render('owner-update', compact('cat_menu', 'restaurant'));
            } else {
                Yii::$app->session->setFlash('error', 'Esa categoria no existe.');
                return $this->redirect(['categorias', 'id' => Yii::$app->getRequest()->getCookies()->getValue('id_restaurant')]);
            }
        }
    }

    public function actionDelete($id)
    {
        $cat_menu = $this->findModel($id);
        $cat_menu->state = 0;
        if ($cat_menu->save()) {
            Yii::$app->session->setFlash('success', 'Se ha eliminado Correctamente.');
        } else {
            Yii::$app->session->setFlash('error', 'No se ha podido eliminar, intente más tarde');
        }
        return $this->redirect(['categorias', 'id' => Yii::$app->getRequest()->getCookies()->getValue('id_restaurant')]);
    }

    public function actionCategorias($id)
    {
        $restaurant = Restaurant::find()->where(['id' => $id, 'res_fkuserowner' => UserOwner::getUserOwnerLogged()->id])->one();

        if (!empty($restaurant)) {
            #Its Restaurant of UserOwnerLogged

            $cookie = new Yii\web\Cookie([
                'name' => 'id_restaurant',
                'value' => $restaurant->id,
            ]);
            Yii::$app->getResponse()->getCookies()->add($cookie);
            $categories = CatMenu::find()->where(['state' => 1, 'catmen_fkrestaurant' => $id])->all();
            return $this->render('owner-allcategorys', compact('categories', 'restaurant'));
        } else {
            $message = 'No tienes ningun Restaurante con ese ID.';
            $name = 'Error';
            return $this->render('/site/error', compact('message', 'name'));
        }
    }

    protected function findModel($id)
    {
        if (($model = CatMenu::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
