<?php

use yii\bootstrap4\Html;

$this->title = "Platillos ({$restaurant->res_name})"

?>

<?= $this->render('/layouts/sidebar-left-client') ?>

<div class="main-panel">

    <?= $this->render('/layouts/navbar') ?>

    <div class="content">

        <!-- My content -->
        <div class="catmenuitem-allPlatillos">
            <h1><?= Html::encode($this->title) ?><a href="/cat-menu-item/create"></a></h1>

            <?php foreach ($categories as $cat) : ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title h2"><?= $cat->catmen_name ?></h4>
                            </div>
                            <div class="card-body row">
                                <?php foreach ($cat->catMenuItems as $items) : ?>
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
                                                        <img class="avatar" src="<?= $items->catmenite_image ?>" alt="">
                                                        <h5 class="title h3"><?= $items->catmenite_name ?></h5>
                                                    </a>
                                                    <p class="description"><?= $items->catmenite_description ?></p>
                                                    <p class="card-description">Para <?= $items->catmenite_for ?> Persona(s)</p>
                                                    <p class="card-description" style="color: red">$<?= $items->catmenite_price ?></p>
                                                </div>
                                                </p>
                                            </div>
                                            <div class="card-footer">
                                                <div class="button-container text-center">
                                                    <input class="text-center" type="number" id='<?= $items->id ?>'><br>
                                                    <a onclick='addToCart(<?= "{$items->id},{$items->catmenite_price}" ?>)' class="btn">Añadir al carrito</a>
                                                </div>
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