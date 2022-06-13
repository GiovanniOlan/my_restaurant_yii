<?php

use yii\bootstrap4\Html;

$this->title = "Tú Carrito";

?>

<?= $this->render('/layouts/sidebar-left-client', compact('restaurant')) ?>

<div class="main-panel">

    <?= $this->render('/layouts/navbar') ?>

    <div class="content">

        <!-- My content -->
        <div class="catmenuitem-allPlatillos">
            <h1><?= Html::encode($this->title) ?><a href="/ticket/generate"><i style='font-size:25px; margin-left: 10px;' class="tim-icons icon-check-2"></i></a></h1>

            <div class="row">
                <?php foreach ($client->carts as $cat) : ?>
                    <div class="col-4">
                        <div class="card card-user">
                            <div class="card-body">
                                <p class="card-text">
                                <div class="author">
                                    <div class="block block-one"></div>
                                    <div class="block block-two"></div>
                                    <div class="block block-three"></div>
                                    <div class="block block-four"></div>
                                    <img class="avatar" src="<?= $cat->carFkcatmenuitem->imageUrl ?>" alt="">
                                    <h5 class="title h3"><?= $cat->carFkcatmenuitem->catmenite_name ?></h5>
                                    <!-- <p class="description">a</p> -->
                                    <p class="card-description" style="font-size:20px;"><?= $cat->car_quantity ?> pz</p>
                                    <p class="card-description" style="color: red; font-size:20px;">$<?= number_format($cat->car_subtotal, 2) ?></p>
                                </div>
                                </p>
                            </div>
                            <div class="card-footer">
                                <div class="button-container">
                                    <a onclick="deleteItemCart(<?= $cat->id ?>)" class="btn btn-icon btn-round"><i class="fas fa-solid fa-trash"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>

        </div>
    </div>
</div>