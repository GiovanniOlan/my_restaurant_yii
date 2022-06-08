<?php

namespace app\controllers;

use Yii;
use yii\db\Query;
use app\models\CatMenu;
use yii\web\Controller;
use app\models\UserOwner;
use app\models\Utilities;
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
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $cat_menu = new CatMenu();

        echo '<pre>';
        var_dump(Utilities::$restaurant);
        echo '</pre>';
        die;

        if ($this->request->isPost) {
            if ($cat_menu->load($this->request->post()) && $cat_menu->save()) {
                return $this->redirect(['view', 'id' => $cat_menu->id]);
            }
        } else {
            $cat_menu->loadDefaultValues();
        }

        if (User::hasRole('owner', false)) {
            return $this->render('owner-create', compact('cat_menu'));
        } else {
            return $this->render('create', 'cat_menu');
        }
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

    public function actionCategorias($id)
    {
        $restaurant = Restaurant::find()->where(['id' => $id, 'res_fkuserowner' => UserOwner::getUserOwnerLogged()->id])->one();

        if (!empty($restaurant)) {
            #Its Restaurant of UserOwnerLogged
            Yii::$app->params['restaurant'];
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
