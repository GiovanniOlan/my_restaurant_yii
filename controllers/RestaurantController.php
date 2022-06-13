<?php

namespace app\controllers;

use Yii;
use DateTime;
use kartik\mpdf\Pdf;
use yii\web\Response;
use app\models\Ticket;
use app\models\Reporte;
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
        if (User::hasRole('owner', false)) {
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

    public function actionReportes()
    {
        $reporte = new Reporte;
        $id_restaurant = Yii::$app->getRequest()->getCookies()->getValue('id_restaurant');
        $restaurant = Restaurant::getRestaurant($id_restaurant);
        if ($this->request->isPost && $reporte->load($this->request->post())) {
            $money_win = (new \yii\db\Query())
                ->select(['SUM(tic_total) AS total'])
                ->from('TICKET')
                ->where(['tic_fkrestaurant' => $restaurant->id, 'state' => 2])
                ->andWhere(['between', 'created_date', $reporte->fechaStart, $reporte->fechaEnd])
                ->one();
            (empty($money_win['total']) ? $money_win['total'] = '$0.00' : $money_win['total'] = '$' . $money_win['total']);

            $clients_men = (new \yii\db\Query())
                ->select(['COUNT(*) AS mens'])
                ->from('TICKET')
                ->innerJoin('CLIENT', 'tic_fkclient = CLIENT.id')
                ->innerJoin('USER_CUSTOM', 'CLIENT.cli_fkusercustom = USER_CUSTOM.id')
                ->where(['TICKET.tic_fkrestaurant' => $restaurant->id, 'TICKET.state' => 2, 'USER_CUSTOM.usu_fkgender' => 1])
                ->andWhere(['between', 'created_date', $reporte->fechaStart, $reporte->fechaEnd])
                ->one();
            $clients_woman = (new \yii\db\Query())
                ->select(['COUNT(*) AS womans'])
                ->from('TICKET')
                ->innerJoin('CLIENT', 'tic_fkclient = CLIENT.id')
                ->innerJoin('USER_CUSTOM', 'CLIENT.cli_fkusercustom = USER_CUSTOM.id')
                ->where(['TICKET.tic_fkrestaurant' => $restaurant->id, 'TICKET.state' => 2, 'USER_CUSTOM.usu_fkgender' => 2])
                ->andWhere(['between', 'created_date', $reporte->fechaStart, $reporte->fechaEnd])
                ->one();

            $jovenes = (new \yii\db\Query())
                ->select(['count(*) as jovenes'])
                ->from('TICKET')
                ->innerJoin('CLIENT', 'tic_fkclient = CLIENT.id')
                ->innerJoin('USER_CUSTOM', 'CLIENT.cli_fkusercustom = USER_CUSTOM.id')
                ->where(['TICKET.tic_fkrestaurant' => $restaurant->id, 'TICKET.state' => 2, 'TIMESTAMPDIFF(YEAR,USER_CUSTOM.usu_datebirth,CURDATE())<' => '30'])
                ->andWhere(['between', 'created_date', $reporte->fechaStart, $reporte->fechaEnd])
                ->one();

            $adultos = (new \yii\db\Query())
                ->select(['count(*) as adultos'])
                ->from('TICKET')
                ->innerJoin('CLIENT', 'tic_fkclient = CLIENT.id')
                ->innerJoin('USER_CUSTOM', 'CLIENT.cli_fkusercustom = USER_CUSTOM.id')
                ->where(['TICKET.tic_fkrestaurant' => $restaurant->id, 'TICKET.state' => 2, 'USER_CUSTOM.usu_fkgender' => 2])
                ->andWhere(['between', 'TIMESTAMPDIFF(YEAR,USER_CUSTOM.usu_datebirth,CURDATE())', '31', '50'])
                ->andWhere(['between', 'created_date', $reporte->fechaStart, $reporte->fechaEnd])
                ->one();
            $mayores = (new \yii\db\Query())
                ->select(['count(*) as mayores'])
                ->from('TICKET')
                ->innerJoin('CLIENT', 'tic_fkclient = CLIENT.id')
                ->innerJoin('USER_CUSTOM', 'CLIENT.cli_fkusercustom = USER_CUSTOM.id')
                ->where(['TICKET.tic_fkrestaurant' => $restaurant->id, 'TICKET.state' => 2, 'TIMESTAMPDIFF(YEAR,USER_CUSTOM.usu_datebirth,CURDATE())>' => '50'])
                ->andWhere(['between', 'created_date', $reporte->fechaStart, $reporte->fechaEnd])
                ->one();

            $items_more_populate = (new \yii\db\Query())
                ->select(['CAT_MENU_ITEM.catmenite_name,TICKET_ITEM.ticite_quantity, SUM(TICKET_ITEM.ticite_quantity) as total_ventas'])
                ->from('TICKET')
                ->innerJoin('TICKET_ITEM', 'TICKET.id = TICKET_ITEM.ticite_fkticket')
                ->innerJoin('CAT_MENU_ITEM', 'TICKET_ITEM.ticite_fkcatmenuitem = CAT_MENU_ITEM.id')
                ->where(['TICKET.tic_fkrestaurant' => $restaurant->id, 'TICKET.state' => 2])
                ->where(['TICKET.tic_fkrestaurant' => $restaurant->id, 'TICKET.state' => 2])
                ->groupBy('CAT_MENU_ITEM.id')
                ->orderBy('SUM(TICKET_ITEM.ticite_quantity) DESC')
                ->all();
            $content = $this->renderPartial('reporte-pdf', compact('restaurant', 'money_win', 'clients_men', 'clients_woman', 'jovenes', 'adultos', 'mayores', 'items_more_populate'));
            $pdf = new Pdf([
                // set to use core fonts only
                'mode' => Pdf::MODE_CORE,
                // A4 paper format
                'format' => Pdf::FORMAT_A4,
                // portrait orientation
                'orientation' => Pdf::ORIENT_PORTRAIT,
                // stream to browser inline
                'destination' => Pdf::DEST_BROWSER,
                // your html content input
                'content' => $content,
                // format content from your own css file if needed or use the
                // enhanced bootstrap css built by Krajee for mPDF formatting 
                'cssFile' => '@app/web/css/site.css',
                // any css to be embedded if required
                'cssInline' => '.kv-heading-1{font-size:18px}',
            ]);

            // return the pdf output as per the destination setting
            return $pdf->render();
        }

        return $this->render('owner-reportes', compact('reporte', 'restaurant'));
    }

    protected function findModel($id)
    {
        if (($model = Restaurant::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
