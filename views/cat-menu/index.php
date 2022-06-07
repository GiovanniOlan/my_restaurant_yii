<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CatMenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cat Menus';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cat-menu-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Cat Menu', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'state',
            'catmen_name',
            'catmen_description:ntext',
            'catmen_image',
            //'catmen_fkrestaurant',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, CatMenu $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
