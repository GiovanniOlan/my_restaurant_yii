<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TicketItemSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ticket-item-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'state') ?>

    <?= $form->field($model, 'ticite_itemname') ?>

    <?= $form->field($model, 'ticite_quantity') ?>

    <?= $form->field($model, 'ticite_price') ?>

    <?php // echo $form->field($model, 'ticite_subtotal') ?>

    <?php // echo $form->field($model, 'ticite_fkticket') ?>

    <?php // echo $form->field($model, 'ticite_fkcatmenuitem') ?>

    <?php // echo $form->field($model, 'created_date') ?>

    <?php // echo $form->field($model, 'created_delete') ?>

    <?php // echo $form->field($model, 'created_update') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
