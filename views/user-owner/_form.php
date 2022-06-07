<?php

use yii\helpers\Html;
use app\models\CatGender;
use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\UserOwner */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-owner-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php // User Custom's field 
    ?>

    <?= $form->field($user_custom, 'usu_nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($user_custom, 'usu_paterno')->textInput(['maxlength' => true]) ?>

    <?= $form->field($user_custom, 'usu_materno')->textInput(['maxlength' => true]) ?>

    <?= $form->field($user_custom, 'usu_datebirth')->input('date') ?>
    <?php /*$form->field($user_custom, 'usu_datebirth')->widget(DatePicker::className(), [
        'model' => $user_custom,
        'attribute' => 'datetime_2',
        'options' => ['placeholder' => 'Fecha De Nacimiento', 'autocomplete' => 'off', 'class' => 'form-crear form-control black'],
        'pluginOptions' => [
            'autoclose' => true
        ]
    ]); */ ?>

    <?= $form->field($user_custom, 'usu_photo')->widget(
        FileInput::classname(),
        [
            'options'       => ['accept' => 'image/*', 'class' => 'form-control black form-crear'],
            'language'      => 'es',
            'pluginOptions' => [
                'allowedFileExtensions' =>  ['jpg', 'gif', 'png'],
                'initialPreview'        => [$user_custom->getUrl()],
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

    <?= $form->field($user_custom, 'usu_fkgender')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(CatGender::find()->all(), 'id', 'catgen_name'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione un Grupo ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>


    <?php // User's field 
    ?>
    <?= $form->field($user, 'username')->textInput(['maxlength' => 255, 'autocomplete' => 'off'])->label('Nombre De Usuario Con El Que Iniciaras Sesión') ?>
    <?= $form->field($user, 'password')->passwordInput(['maxlength' => 255, 'autocomplete' => 'off']) ?>
    <?= $form->field($user, 'repeat_password')->passwordInput(['maxlength' => 255, 'autocomplete' => 'off']) ?>
    <?= $form->field($user, 'email')->textInput(['maxlength' => 255]) ?>




    <?php // User Owner's field 
    ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>