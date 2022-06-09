<?php

use yii\bootstrap4\Html;

$this->title = "Platillos ({$restaurant->res_name})"

?>

<?= $this->render('/layouts/sidebar-left-restaurant') ?>

<div class="main-panel">

    <?= $this->render('/layouts/navbar') ?>

    <div class="content">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Mis Restaurantes</a></li>
                <li class="breadcrumb-item"><a href="/restaurant/view/<?= $restaurant->id ?>"><?= $restaurant->res_name ?></a></li>
                <li class="breadcrumb-item active" aria-current="page">Platillos</li>
            </ol>
        </nav>
        <!-- My content -->
        <div class="catmenuitem-allPlatillos">
            <h1><?= Html::encode($this->title) ?><a href="/cat-menu-item/create"><i style='font-size:25px; margin-left: 10px;' class="tim-icons icon-simple-add"></i></a></h1>

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
                                                    <!-- <p class="description">a</p> -->
                                                    <p class="card-description">Para <?= $items->catmenite_for ?> Persona(s)</p>
                                                    <!-- <p class="card-description" style="color: red">asd</p> -->
                                                </div>
                                                </p>
                                            </div>
                                            <div class="card-footer">
                                                <div class="button-container">
                                                    <a href="/cat-menu-item/view?id=<?= $items->id ?>" class="btn btn-icon btn-round"><i class="fas fa-solid fa-eye"></i></a>
                                                    <a href="/cat-menu-item/update?id=<?= $items->id ?>" class="btn btn-icon btn-round"><i class="fas fa-solid fa-eye-dropper"></i></i></a>
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