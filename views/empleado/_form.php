<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Empleado */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="empleado-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'state')->textInput() ?>

    <?= $form->field($model, 'emp_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'emp_curp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'emp_rfc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'emp_fkrestaurant')->textInput() ?>

    <?= $form->field($model, 'emp_fkusercustom')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
