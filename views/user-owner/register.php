<?php

use yii\bootstrap4\Html;
use app\models\CatGender;
use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\bootstrap4\ActiveForm;

?>
<div class="container">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center">
            <div class="card card-user">
                <?php $form = ActiveForm::begin([
                    'options' => ['autocomplete' => 'off'],
                ]); ?>
                <div class="card-body">
                    <div class="author">
                        <div class="block block-one"></div>
                        <div class="block block-two"></div>
                        <div class="block block-three"></div>
                        <div class="block block-four"></div>
                        <img class="avatar" src="/upload/images/default/user-default.png" alt="...">
                        <h5 class="title h3">Registrate Para Manejar Tus Restaurantes</h5>
                    </div>

                    <div class="row">


                        <?= $form->field($user_custom, 'usu_nombre', ['options' => ['class' => 'col-3']])->textInput(['maxlength' => true]) ?>

                        <?= $form->field($user_custom, 'usu_paterno', ['options' => ['class' => 'col-3']])->textInput(['maxlength' => true]) ?>

                        <?= $form->field($user_custom, 'usu_materno', ['options' => ['class' => 'col-3']])->textInput(['maxlength' => true]) ?>

                        <?= $form->field($user_custom, 'usu_datebirth', ['options' => ['class' => 'col-3']])->input('date') ?>

                        <div class="col-6">

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

                        </div>

                        <?= $form->field($user_custom, 'img', ['options' => ['class' => 'col-6']])->widget(
                            FileInput::classname(),
                            [
                                'options'       => ['accept' => 'image/*', 'class' => 'form-control black form-crear'],
                                'language'      => 'es',
                                'pluginOptions' => [
                                    'initialPreview'        => (empty($user_custom->usu_photo) ? false : $user_custom->photoUrl),
                                    'initialPreviewAsData'  => true,
                                    'showCaption'           => false,
                                    'showRemove'            => false,
                                    'showCancel'            => false,
                                    'showUpload'            => false,
                                    'browseClass'           => 'btn btn-secondary btn-block',
                                    'browseIcon'            => '<i class="fas fa-camera"></i> ',
                                    'browseLabel'           =>  'Seleccione una foto',
                                ],
                            ]
                        );
                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="card-footer">
                        <button type="submit" style="margin-top: -20px" class="btn btn-fill btn-primary">Registrarse</button>
                    </div>
                    <p>O</p>
                    <a class="" href="/site/login">Iniciar Sesión</a>
                    <p>O</p>
                    <a class="" href="/client/register">Registrate Como Cliente</a>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>