<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CatMenuSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cat-menu-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'state') ?>

    <?= $form->field($model, 'catmen_name') ?>

    <?= $form->field($model, 'catmen_description') ?>

    <?= $form->field($model, 'catmen_image') ?>

    <?php // echo $form->field($model, 'catmen_fkrestaurant') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
