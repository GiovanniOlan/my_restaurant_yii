<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Ticket */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ticket-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'state')->textInput() ?>

    <?= $form->field($model, 'created_date')->textInput() ?>

    <?= $form->field($model, 'delete_date')->textInput() ?>

    <?= $form->field($model, 'update_date')->textInput() ?>

    <?= $form->field($model, 'tic_total')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tic_clientname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tic_file')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tic_fkclient')->textInput() ?>

    <?= $form->field($model, 'tic_fkrestaurant')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
