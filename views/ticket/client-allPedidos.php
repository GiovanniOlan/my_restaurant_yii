<?php

use yii\bootstrap4\Html;

$this->title = "Tus Pedidos";

?>

<?= $this->render('/layouts/sidebar-left-client') ?>

<div class="main-panel">

    <?= $this->render('/layouts/navbar') ?>

    <div class="content">
        <!-- My content -->
        <div class="catmenuitem-allPlatillos">
            <h1><?= Html::encode($this->title) ?></h1>

            <?php foreach ($client->tickets as $tic) : ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title h2"><?= "(Fecha: {$tic->created_date}) - (Cliente: {$tic->tic_clientname}) - (Total:{$tic->tic_total})" ?></h4>
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