<?php

use yii\helpers\Html;
use kartik\file\FileInput;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CatMenu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cat-menu-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="form-group">
        <label class="control-label" style="font-size: 25px;">Restaurante</label>
        <input type="text" id="ordencompra-ord_fkusuario" style="color:white; font-size: 25px;" class="form-control" value="<?= $restaurant->res_name ?>" disabled aria-required="true">
        <div class="help-block"></div>
    </div>
    <br>
    <hr style="background-color:white;">
    <br>
    <?= $form->field($cat_menu, 'catmen_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($cat_menu, 'catmen_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($cat_menu, 'img')->widget(
        FileInput::classname(),
        [
            'options'       => ['accept' => 'image/*', 'class' => 'form-control black form-crear'],
            'language'      => 'es',
            'pluginOptions' => [
                'allowedFileExtensions' =>  ['jpg', 'jpeg', 'png'],
                'initialPreview'        => [$cat_menu->getImageUrl()],
                'initialPreviewAsData'  => true,
                'showCaption'           => false,
                'showRemove'            => false,
                'showUpload'            => false,
                'browseClass'           => 'btn btn-primary btn-block',
                'browseIcon'            => '<i class="fas fa-camera"></i> ',
                'browseLabel'           =>  'Seleccione una foto',
            ],
        ]
    );
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>