<?php

namespace app\controllers;

use Yii;
use app\models\Cart;
use yii\web\Response;
use app\models\Client;
use yii\web\Controller;
use app\models\CartSearch;
use app\models\Restaurant;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use webvimark\modules\UserManagement\models\User;

/**
 * CartController implements the CRUD actions for Cart model.
 */
class CartController extends Controller
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

    /**
     * Lists all Cart models.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (User::hasRole('restaurant_client', false)) {
            $client = Client::getClientLogged();
            $restaurant = Restaurant::getRestaurant($client->cli_fkrestaurant);
            $items_cart = $client->carts;
            return $this->render('client-cart', compact('restaurant', 'client', 'items_cart'));
        } else {
            $searchModel = new CartSearch();
            $dataProvider = $searchModel->search($this->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    /**
     * Displays a single Cart model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Cart model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Cart();

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

    /**
     * Updates an existing Cart model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
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

    /**
     * Deletes an existing Cart model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Cart model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Cart the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cart::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionAddCart()
    {
        if (Yii::$app->request->isAjax) {
            $car_fkcatmenuitem = $this->request->post('cat_menu_item_id');
            $car_quantity = $this->request->post('quantity');
            $item_price = $this->request->post('price');

            $car_exist = Cart::find()->where(['car_fkcatmenuitem' => $car_fkcatmenuitem, 'car_fkclient' => Client::getClientLogged()->id, 'state' => 1])->one();
            if (empty($car_exist)) {
                $cart = new Cart();
                $cart->state = 1;
                $cart->car_fkcatmenuitem = $car_fkcatmenuitem;
                $cart->car_quantity = $car_quantity;
                $cart->car_subtotal = ($item_price * $cart->car_quantity);
                $cart->car_fkclient = Client::getClientLogged()->id;
            } else {
                $car_exist->car_quantity += $car_quantity;
                $car_exist->car_subtotal = ($item_price * $car_exist->car_quantity);
                $cart = $car_exist;
            }
            $response = Yii::$app->response;
            $response->format = Response::FORMAT_JSON;
            if ($cart->save()) {
                $response->data = true;
                return $response;
            } else {
                $response->data = false;
                return $response;
            }
            return $response;
        } else {
            Yii::$app->session->setFlash('error', 'No tienes permitido esta acción');
            return $this->redirect(['/']);
        }
    }

    public function actionDeleteItemCart()
    {
        if (Yii::$app->request->isAjax) {

            $id = $this->request->post('cart_id');
            $cart = $this->findModel($id);
            $cart->state = 0;

            $response = Yii::$app->response;
            $response->format = Response::FORMAT_JSON;
            if ($cart->save()) {
                $response->data = true;
            } else {
                $response->data = false;
            }
            return $response;
        } else {
            Yii::$app->session->setFlash('error', 'No tienes permitido esta acción');
            return $this->redirect(['/']);
        }
    }
}
