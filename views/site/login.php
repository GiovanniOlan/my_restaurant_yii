<?php

use yii\bootstrap4\ActiveForm;

?>
<div class="container">
    <div class="row justify-content-center align-items-center ">
        <div class="mt-5  col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 text-center">
            <div class="card card-user">
                <?php $form = ActiveForm::begin([
                    //'layout' => 'horizontal',
                    'options' => ['autocomplete' => 'off'],
                    'validateOnBlur' => false,
                    'fieldConfig' => [
                        'template' => "{input}\n{error}",
                    ],
                ]); ?>
                <div class="card-body">
                    <div class="author">
                        <div class="block block-one"></div>
                        <div class="block block-two"></div>
                        <div class="block block-three"></div>
                        <div class="block block-four"></div>
                        <img class="avatar" src="/upload/images/default/user-default.png" alt="...">
                        <h5 class="title h3">Inicia Sesión</h5>
                    </div>
                    <div class="form-group">
                        <label>Usuario</label>
                        <?= $form->field($model, 'username', ['options' => ['tag' => false,]])
                            ->textInput(['placeholder' => 'Usuario', 'autocomplete' => 'off', 'class' => 'form-control form-control-lg']) ?>
                    </div>
                    <div class="form-group">
                        <label>Contraseña</label>
                        <?= $form->field($model, 'password', ['options' => ['tag' => false,]])
                            ->passwordInput(['placeholder' => 'Contraseña', 'autocomplete' => 'off', 'class' => 'form-control form-control-lg']) ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="card-footer">
                        <button type="submit" style="margin-top: -20px" class="btn btn-fill btn-primary">Iniciar Sesion</button>
                    </div>
                    <p>O</p>
                    <a class="" href="/user-owner/register">Registrate Como Dueño De Restarante</a>
                    <p>O</p>
                    <a class="" href="/client/register">Registrate Como Cliente</a>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>