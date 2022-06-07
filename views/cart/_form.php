<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Cart */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cart-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'state')->textInput() ?>

    <?= $form->field($model, 'car_fkcatmenuitem')->textInput() ?>

    <?= $form->field($model, 'car_quantity')->textInput() ?>

    <?= $form->field($model, 'car_subtotal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'car_fkclient')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
