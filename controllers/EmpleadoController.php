<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Empleado;
use app\models\Utilities;
use yii\web\UploadedFile;
use app\models\Restaurant;
use app\models\UserCustom;
use yii\filters\VerbFilter;
use app\models\EmpleadoSearch;
use yii\web\NotFoundHttpException;
use webvimark\modules\UserManagement\models\User;

/**
 * EmpleadoController implements the CRUD actions for Empleado model.
 */
class EmpleadoController extends Controller
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
     * Lists all Empleado models.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (User::hasRole('restaurant_empleado', false)) {
            $empleado = Empleado::getEmpleadoLogged();

            return $this->render('empleado-pedidos', compact('empleado'));
        } else {
            $searchModel = new EmpleadoSearch();
            $dataProvider = $searchModel->search($this->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    public function actionView($id)
    {
        $empleado = $this->findModel($id);
        if (User::hasRole('owner', false)) {
            $id_restaurant = Yii::$app->getRequest()->getCookies()->getValue('id_restaurant');
            if ($empleado->empFkrestaurant->id == $id_restaurant) {
                $restaurant = Restaurant::getRestaurant($id_restaurant);
                return $this->render('owner-view', compact('empleado', 'restaurant'));
            } else {
                Yii::$app->session->setFlash('error', 'Selecciona una resturante para acceder a más opciones.');
                return $this->redirect(['/']);
            }
        }
    }

    public function actionCreate()
    {
        $user = new User;
        $user_custom = new UserCustom;
        $empleado = new Empleado;


        if (User::hasRole('owner', false)) {
            $id_restaurant = Yii::$app->getRequest()->getCookies()->getValue('id_restaurant');
            if ($id_restaurant != null) {
                $restaurant = Restaurant::getRestaurant($id_restaurant);
                if ($this->request->isPost) {
                    if ($empleado->load($this->request->post()) && $user->load($this->request->post()) &&  $user_custom->load($this->request->post())) {
                        $user->auth_key        = Yii::$app->security->generateRandomString();
                        $user->password_hash   = Yii::$app->security->generatePasswordHash($user->password);
                        $user->status          = 1;
                        $user->created_at      = time();
                        $user->updated_at      = time();
                        $user->email_confirmed = 1;
                        if ($user->save()) {
                            User::assignRole($user->id, "restaurant_empleado");
                            $user_custom->usu_fkuser = $user->id;
                            $img = UploadedFile::getInstance($user_custom, 'img');
                            if (!empty($img)) {
                                $response = Utilities::uploadImage('/upload/images/user-custom/', $img);
                                if (!empty($response)) {
                                    $user_custom->usu_photo = $response;
                                } else {
                                    Yii::$app->session->setFlash('Se ha creado el Empleado, pero no se subio la imagen, pruebe editando la categoria.');
                                }
                            }
                            if ($user_custom->save()) {
                                $empleado->emp_fkusercustom = $user_custom->id;
                                $empleado->state = 1;
                                $empleado->emp_fkrestaurant = $restaurant->id;
                                if ($empleado->save()) {
                                    return $this->redirect(['view', 'id' => $empleado->id]);
                                }
                                $user_custom->delete();
                            }
                            $user->delete();
                        }
                        Yii::$app->session->setFlash('Error', 'No se guardar tu usuario, intentelo mas tarde');
                    }
                } else {
                    $empleado->loadDefaultValues();
                }

                return $this->render('owner-create', compact('empleado', 'user', 'user_custom', 'restaurant'));
            } else {
                Yii::$app->session->setFlash('error', 'Selecciona una resturante para acceder a más opciones.');
                return $this->redirect(['/']);
            }
        }
    }

    public function actionUpdate($id)
    {
        $empleado = $this->findModel($id);
        $user_custom = $empleado->empFkusercustom;
        $user = $user_custom->usuFkuser;

        if (User::hasRole('owner', false)) {
            $id_restaurant = Yii::$app->getRequest()->getCookies()->getValue('id_restaurant');
            if ($empleado->emp_fkrestaurant == $id_restaurant) {
                $restaurant = Restaurant::getRestaurant($id_restaurant);
                if ($this->request->isPost) {
                    if ($empleado->load($this->request->post())) {
                        $empleado->save();
                    }
                    if ($user_custom->load($this->request->post())) {
                        $img = UploadedFile::getInstance($user_custom, 'img');
                        if (!empty($img)) {
                            $response = Utilities::uploadImage('/upload/images/user-custom/', $img);
                            if (!empty($response)) {
                                if (!empty($user_custom->usu_photo)) {
                                    unlink(Yii::$app->basePath . "/web" . $user_custom->usu_photo);
                                }
                                $user_custom->usu_photo = $response;
                            } else {
                                Yii::$app->getSession()->setFlash('Se ha creado el empleado, pero no se subio la imagen, pruebe editandolo más tarde.');
                            }
                        }
                        $user_custom->save();
                    }
                    if ($user->load($this->request->post())) {
                        $user->save();
                    }
                    return $this->redirect(['view', 'id' => $empleado->id]);
                }

                return $this->render('owner-update', compact('restaurant', 'empleado', 'user', 'user_custom'));
            } else {
                Yii::$app->session->setFlash('error', 'Selecciona uno de tus resturantes para acceder a más opciones.');
                return $this->redirect(['/']);
            }
        }
    }

    public function actionDelete($id)
    {
        $empleado = $this->findModel($id);
        $empleado->state = 0;

        if ($empleado->save()) {
            Yii::$app->session->setFlash('success', 'El Personal se ha elimando correctamente.');
        } else {
            Yii::$app->session->setFlash('error', 'No se ha podido eliminar el platillo, intente más tarde.');
        }
        return $this->redirect(['todos']);
    }

    public function actionTodos()
    {
        if (User::hasRole('owner')) {
            $id_restaurant = Yii::$app->getRequest()->getCookies()->getValue('id_restaurant');
            if ($id_restaurant != null) {
                $restaurant = Restaurant::getRestaurant($id_restaurant);
                $empleados = $restaurant->empleados;
                return $this->render('owner-allEmpleados', compact('empleados', 'restaurant'));
            } else {
                Yii::$app->session->setFlash('error', 'Selecciona uno de tus resturantes para acceder a más opciones.');
                return $this->redirect(['/']);
            }
        }
    }

    protected function findModel($id)
    {
        if (($model = Empleado::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
