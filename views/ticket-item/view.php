<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TicketItem */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ticket Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="ticket-item-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'state',
            'ticite_itemname',
            'ticite_quantity',
            'ticite_price',
            'ticite_subtotal',
            'ticite_fkticket',
            'ticite_fkcatmenuitem',
            'created_date',
            'created_delete',
            'created_update',
        ],
    ]) ?>

</div>
