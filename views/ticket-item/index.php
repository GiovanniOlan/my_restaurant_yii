<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TicketItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ticket Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ticket-item-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Ticket Item', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'state',
            'ticite_itemname',
            'ticite_quantity',
            'ticite_price',
            //'ticite_subtotal',
            //'ticite_fkticket',
            //'ticite_fkcatmenuitem',
            //'created_date',
            //'created_delete',
            //'created_update',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, TicketItem $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
