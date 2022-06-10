<?php

use yii\helpers\Html;
use app\models\CatGender;
use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Empleado */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="empleado-form">

    <?php $form = ActiveForm::begin(['options' => ['class' => 'row card-body']]); ?>


    <?= $form->field($user_custom, 'usu_nombre', ['options' => ['class' => 'col-3']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($user_custom, 'usu_paterno', ['options' => ['class' => 'col-3']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($user_custom, 'usu_materno', ['options' => ['class' => 'col-3']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($user_custom, 'usu_datebirth', ['options' => ['class' => 'col-3']])->input('date') ?>
    <?php /*$form->field($user_custom, 'usu_datebirth')->widget(DatePicker::className(), [
        'model' => $user_custom,
        'attribute' => 'datetime_2',
        'options' => ['placeholder' => 'Fecha De Nacimiento', 'autocomplete' => 'off', 'class' => 'form-crear form-control black'],
        'pluginOptions' => [
            'autoclose' => true
        ]
    ]); */ ?>

    <?= $form->field($empleado, 'emp_curp', ['options' => ['class' => 'col-3']])->textInput(['maxlength' => true]) ?>
    <?= $form->field($empleado, 'emp_rfc', ['options' => ['class' => 'col-3']])->textInput(['maxlength' => true]) ?>
    <?= $form->field($user_custom, 'usu_fkgender', ['options' => ['class' => 'col-3']])->widget(Select2::classname(), [
        'data' => ArrayHelper::map(CatGender::find()->all(), 'id', 'catgen_name'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione un Grupo ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>
    <?= $form->field($user, 'email', ['options' => ['class' => 'col-3']])->textInput(['maxlength' => 255]) ?>


    <div class="col-6">
        <?= $form->field($user, 'username')->textInput(['maxlength' => 255, 'autocomplete' => 'off'])->label('Nombre De Usuario') ?>
        <?= $form->field($user, 'password')->passwordInput(['maxlength' => 255, 'autocomplete' => 'off']) ?>
        <?= $form->field($user, 'repeat_password')->passwordInput(['maxlength' => 255, 'autocomplete' => 'off']) ?>
        <?= $form->field($empleado, 'emp_description')->textarea(['rows' => 6]) ?>
    </div>





    <?= $form->field($user_custom, 'img', ['options' => ['class' => 'col-6']])->widget(
        FileInput::classname(),
        [
            'options'       => ['accept' => 'image/*', 'class' => 'form-control black form-crear'],
            'language'      => 'es',
            'pluginOptions' => [
                'allowedFileExtensions' =>  ['jpg', 'gif', 'png'],
                'initialPreview'        => (empty($user_custom->usu_photo) ? false : [$user_custom->photoUrl]),
                'initialPreviewAsData'  => true,
                'showCaption'           => false,
                'showRemove'            => false,
                'showUpload'            => false,
                'showCancel'            => false,
                'browseClass'           => 'btn btn-primary btn-block',
                'browseIcon'            => '<i class="fas fa-camera"></i> ',
                'browseLabel'           =>  'Seleccione una foto',
            ],
        ]
    );
    ?>





    <div class="col-12">
        <div class="text-center">
            <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>