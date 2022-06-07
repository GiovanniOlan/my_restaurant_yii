<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CatMenuItem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cat-menu-item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'state')->textInput() ?>

    <?= $form->field($model, 'catmenite_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'catmenite_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'catmenite_for')->textInput() ?>

    <?= $form->field($model, 'catmenite_image')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'catmenite_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'catmenite_fkcatmenu')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
