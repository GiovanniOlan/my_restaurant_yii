<?php

use yii\helpers\Html;
use kartik\file\FileInput;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Restaurant */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="restaurant-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($restaurant, 'res_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($restaurant, 'res_description')->textarea(['rows' => 6]) ?>


    <?= $form->field($restaurant, 'res_slogan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($restaurant, 'img_logo')->widget(
        FileInput::classname(),
        [
            'options'       => ['accept' => 'image/*', 'class' => 'form-control black form-crear'],
            'language'      => 'es',
            'pluginOptions' => [
                'allowedFileExtensions' =>  ['jpg', 'jpeg', 'png'],
                'initialPreview'        => [$restaurant->getLogoUrl()],
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

    <?= $form->field($restaurant, 'img_mainimage')->widget(
        FileInput::classname(),
        [
            'options'       => ['accept' => 'image/*', 'class' => 'form-control black form-crear'],
            'language'      => 'es',
            'pluginOptions' => [
                'allowedFileExtensions' =>  ['jpg', 'jpeg', 'png'],
                'initialPreview'        => [$restaurant->getMainImageUrl()],
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