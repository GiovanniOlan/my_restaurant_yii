<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TicketItem */

$this->title = 'Create Ticket Item';
$this->params['breadcrumbs'][] = ['label' => 'Ticket Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ticket-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
