<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserCustom */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-custom-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'usu_nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'usu_paterno')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'usu_materno')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'usu_datebirth')->textInput() ?>

    <?= $form->field($model, 'usu_photo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'usu_fkgender')->textInput() ?>

    <?= $form->field($model, 'usu_fkuser')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
