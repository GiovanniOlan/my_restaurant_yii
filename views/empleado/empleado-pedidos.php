<?php

use yii\bootstrap4\Html;

$this->title = "Pedidos de {$empleado->empFkrestaurant->res_name}";

?>

<?= $this->render('/layouts/sidebar-left-empleado') ?>

<div class="main-panel">

    <?= $this->render('/layouts/navbar') ?>

    <div class="content">
        <!-- My content -->
        <div class="catmenuitem-allPlatillos">
            <h1><?= Html::encode($this->title) ?></h1>

            <?php foreach ($empleado->empFkrestaurant->tickets as $tic) : ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <?php if ($tic->state == 1) : ?>
                                    <h4 class="card-title h2"><?= "(Fecha: {$tic->created_date}) - (Cliente: {$tic->tic_clientname}) - 
                                (Total: {$tic->tic_total}) - (Estado: {$tic->stringState})" ?><a href="/ticket/cancel/?id=<?= $tic->id ?>"><i style='font-size:25px; margin-left: 10px;' class="tim-icons icon-simple-remove"></i></a>
                                        <a href="/ticket/aceptar/?id=<?= $tic->id ?>"><i style='font-size:25px; margin-left: 10px;' class="tim-icons icon-check-2"></i></a>
                                    </h4>
                                <?php else : ?>
                                    <h4 class="card-title h2"><?= "(Fecha: {$tic->created_date}) - (Cliente: {$tic->tic_clientname}) - 
                                (Total: {$tic->tic_total}) - (Estado: {$tic->stringState})" ?></h4>
                                <?php endif ?>
                            </div>
                            <div class="card-body row">
                                <?php foreach ($tic->ticketItems as $items) : ?>
                                    <div class="col-3">
                                        <div class="card card-user">
                                            <div class="card-body">
                                                <p class="card-text">
                                                <div class="author">
                                                    <div class="block block-one"></div>
                                                    <div class="block block-two"></div>
                                                    <div class="block block-three"></div>
                                                    <div class="block block-four"></div>
                                                    <a href="#">
                                                        <img class="avatar" src="<?= $items->ticiteFkcatmenuitem->imageUrl ?>" alt="">
                                                        <h5 class="title h3"><?= $items->ticite_itemname ?></h5>
                                                    </a>
                                                    <!-- <p class="description">a</p> -->
                                                    <p class="card-description">Catidad: <?= $items->ticite_quantity ?> </p>
                                                    <p class="card-description" style="color: red"><?= $items->ticite_subtotal ?></p>
                                                </div>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach ?>

                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>

        </div>
    </div>
</div>