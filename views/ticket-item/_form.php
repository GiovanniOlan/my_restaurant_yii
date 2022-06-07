<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TicketItem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ticket-item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'state')->textInput() ?>

    <?= $form->field($model, 'ticite_itemname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ticite_quantity')->textInput() ?>

    <?= $form->field($model, 'ticite_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ticite_subtotal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ticite_fkticket')->textInput() ?>

    <?= $form->field($model, 'ticite_fkcatmenuitem')->textInput() ?>

    <?= $form->field($model, 'created_date')->textInput() ?>

    <?= $form->field($model, 'created_delete')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_update')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
