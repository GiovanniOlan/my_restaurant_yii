<?php

namespace app\controllers;

use Yii;
use app\models\Cart;
use app\models\Client;
use app\models\Compra;
use app\models\Ticket;
use yii\web\Controller;
use app\models\Empleado;
use app\models\TicketItem;
use yii\filters\VerbFilter;
use app\models\TicketSearch;
use yii\web\NotFoundHttpException;


class TicketController extends Controller
{

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
        $searchModel = new TicketSearch();
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
        $model = new Ticket();

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

    public function actionGenerate()
    {
        $client = Client::getClientLogged();
        $items_cart = Cart::find()->where(['car_fkclient' => $client->id, 'state' => 1])->all();

        $items_cart_total = (new \yii\db\Query())
            ->select(['SUM(car_subtotal) AS total'])
            ->from('CART')
            ->where(['car_fkclient' => $client->id, 'state' => 1])
            ->one();
        if (empty($items_cart)) {
            Yii::$app->session->setFlash('error', 'Tienes que agregar platillos a tu carrito primero.');
            return $this->redirect(['/']);
        } else {


            $ticket = new Ticket;
            $ticket->state = 1;
            $ticket->created_date = date('Y-m-d h:i:s');
            $ticket->delete_date = date('Y-m-d h:i:s');
            $ticket->update_date = date('Y-m-d h:i:s');
            $ticket->tic_total = $items_cart_total['total'];
            $ticket->tic_clientname = $client->cliFkusercustom->longName;
            $ticket->tic_file = 'nada.pdf';
            $ticket->tic_fkclient = $client->id;
            $ticket->tic_fkrestaurant = $client->cli_fkrestaurant;

            if ($ticket->save()) {
                foreach ($items_cart as $i) {
                    $ticket_item = new TicketItem;
                    $ticket_item->state = 1;
                    $ticket_item->ticite_itemname = $i->carFkcatmenuitem->catmenite_name;
                    $ticket_item->ticite_quantity = $i->car_quantity;
                    $ticket_item->ticite_price = $i->carFkcatmenuitem->catmenite_price;
                    $ticket_item->ticite_subtotal = $i->car_subtotal;
                    $ticket_item->ticite_fkticket = $ticket->id;
                    $ticket_item->ticite_fkcatmenuitem = $i->car_fkcatmenuitem;
                    $ticket_item->created_date = date('Y-m-d h:i:s');
                    $ticket_item->created_delete = date('Y-m-d h:i:s');
                    $ticket_item->created_update = date('Y-m-d h:i:s');

                    $i->state = 2; //2 quiere decir que lo compraron.
                    $i->save();

                    $ticket_item->save();
                }
                Yii::$app->session->setFlash('success', "Muchas gracias por tú compra, se ha hecho un cargo a tu tarjeta de $ {$items_cart_total['total']}");
                return $this->redirect(['/']);
            }
        }
    }

    public function actionPedidos()
    {
        $client = Client::getClientLogged();
        $restaurant = $client->cliFkrestaurant;
        #$pedidos = Ticket::find()->where(['tic_fkclient' => $client->id])->all();

        return $this->render('client-allPedidos', compact('restaurant', 'client'));
    }

    public function actionCancel($id)
    {
        $ticket = $this->findModel($id);
        $ticket->state = 0;
        $ticket->save();

        Yii::$app->session->setFlash('success', "Se ha cancelado correctamente la orden, el dinero se le devolvera al cliente.");

        return $this->redirect(['/empleado']);
    }
    public function actionAceptar($id)
    {
        $ticket = $this->findModel($id);
        $ticket->state = 2;
        if ($ticket->save()) {

            $compra = new Compra;
            $compra->state = 1;
            $compra->created_date = date('Y-m-d h:i:s');
            $compra->update_date = date('Y-m-d h:i:s');
            $compra->delete_date = date('Y-m-d h:i:s');
            $compra->com_fkempleado = Empleado::getEmpleadoLogged()->id;
            $compra->com_fkticket = $ticket->id;
            if ($compra->save()) {
                Yii::$app->session->setFlash('success', "La orden ha sido aceptada, el cliente vendra en cualquier momento a buscar su orden.");

                return $this->redirect(['/empleado']);
            } else {
                // $ticket->state = 1;
                // $ticket->save();
                echo '<pre>';
                var_dump($compra->errors);
                echo '</pre>';
                die;
            }
        }
    }


    protected function findModel($id)
    {
        if (($model = Ticket::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
