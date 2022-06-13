<?php

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

$this->title = "Reportes"

?>

<?= $this->render('/layouts/sidebar-left-client', compact('restaurant')) ?>

<div class="main-panel">

    <?= $this->render('/layouts/navbar') ?>

    <div class="content">

        <!-- My content -->
        <div class="catmenuitem-allPlatillos">
            <h1><?= Html::encode($this->title) ?><a href="/cat-menu-item/create"></a></h1>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <!-- <div class="card-header">
                            <h4 class="card-title h2">asdf</h4>
                        </div> -->
                        <?php $form = ActiveForm::begin(['options' => ['class' => 'card-body row']]); ?>


                        <?= $form->field($reporte, 'fechaStart', ['options' => ['class' => 'col-6']])->input('datetime-local') ?>
                        <?= $form->field($reporte, 'fechaEnd', ['options' => ['class' => 'col-6']])->input('datetime-local') ?>

                        <div class="col-12 text-center">
                            <?= Html::submitButton('Consultar', ['class' => 'btn btn-primary']) ?>

                        </div>

                        <?php ActiveForm::end(); ?>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>