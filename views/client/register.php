<?php

use yii\bootstrap4\Html;

$this->title = "Registrate";

?>


<div class="main-panel">


    <div class="container">
        <!-- My content -->
        <div class="client-register">
            <div class="text-center align-items-center justify-content-center card" style="margin-top: 30px; padding-top:25px">
                <h1><?= Html::encode($this->title) ?></h1>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <?= $this->render('_form', compact('client', 'user', 'user_custom'))
                        ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>