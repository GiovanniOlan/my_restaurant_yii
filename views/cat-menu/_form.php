<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CatMenu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cat-menu-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'state')->textInput() ?>

    <?= $form->field($model, 'catmen_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'catmen_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'catmen_image')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'catmen_fkrestaurant')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
