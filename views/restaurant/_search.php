<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RestaurantSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="restaurant-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'state') ?>

    <?= $form->field($model, 'res_name') ?>

    <?= $form->field($model, 'res_description') ?>

    <?= $form->field($model, 'res_logo') ?>

    <?php // echo $form->field($model, 'res_slogan') ?>

    <?php // echo $form->field($model, 'res_mainimage') ?>

    <?php // echo $form->field($model, 'res_fkuserowner') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
