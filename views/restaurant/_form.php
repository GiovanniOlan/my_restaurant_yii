<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Restaurant */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="restaurant-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'state')->textInput() ?>

    <?= $form->field($model, 'res_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'res_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'res_logo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'res_slogan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'res_mainimage')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'res_fkuserowner')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
