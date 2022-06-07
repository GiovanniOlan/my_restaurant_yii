<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CatMenuItemSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cat-menu-item-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'state') ?>

    <?= $form->field($model, 'catmenite_name') ?>

    <?= $form->field($model, 'catmenite_description') ?>

    <?= $form->field($model, 'catmenite_for') ?>

    <?php // echo $form->field($model, 'catmenite_image') ?>

    <?php // echo $form->field($model, 'catmenite_price') ?>

    <?php // echo $form->field($model, 'catmenite_fkcatmenu') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
