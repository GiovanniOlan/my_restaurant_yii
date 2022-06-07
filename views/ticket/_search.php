<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TicketSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ticket-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'state') ?>

    <?= $form->field($model, 'created_date') ?>

    <?= $form->field($model, 'delete_date') ?>

    <?= $form->field($model, 'update_date') ?>

    <?php // echo $form->field($model, 'tic_total') ?>

    <?php // echo $form->field($model, 'tic_clientname') ?>

    <?php // echo $form->field($model, 'tic_file') ?>

    <?php // echo $form->field($model, 'tic_fkclient') ?>

    <?php // echo $form->field($model, 'tic_fkrestaurant') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
