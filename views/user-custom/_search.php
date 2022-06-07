<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserCustomSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-custom-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'usu_nombre') ?>

    <?= $form->field($model, 'usu_paterno') ?>

    <?= $form->field($model, 'usu_materno') ?>

    <?= $form->field($model, 'usu_datebirth') ?>

    <?php // echo $form->field($model, 'usu_photo') ?>

    <?php // echo $form->field($model, 'usu_fkgender') ?>

    <?php // echo $form->field($model, 'usu_fkuser') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
