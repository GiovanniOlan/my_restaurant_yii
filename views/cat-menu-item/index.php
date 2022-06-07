<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CatMenuItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cat Menu Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cat-menu-item-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Cat Menu Item', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'state',
            'catmenite_name',
            'catmenite_description:ntext',
            'catmenite_for',
            //'catmenite_image',
            //'catmenite_price',
            //'catmenite_fkcatmenu',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, CatMenuItem $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
