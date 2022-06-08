<?php

use yii\bootstrap4\Html;
use app\models\UserOwner;
use app\models\Utilities;
use app\models\UserCustom;

// $user_owner = UserOwner::getUserOwnerLogged();

// $restaurants = $user_owner->restaurants;

$this->title = $restaurant->res_name . ": CATEGORIAS";

?>

<?= $this->render('/layouts/sidebar-left-restaurant', compact('restaurant')) ?>

<div class="main-panel">
    <?= $this->render('/layouts/navbar') ?>
    <div class="content">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Mis Restaurantes</a></li>
                <li class="breadcrumb-item"><a href="/restaurant/view/<?= $restaurant->id ?>"><?= $restaurant->res_name ?></a></li>
                <li class="breadcrumb-item active" aria-current="page">Categorias</li>
            </ol>
        </nav>
        <!-- My content -->
        <div class="row">
            <h5 class="h3 col-10" style="color: #fff;"><?= Html::encode($this->title) ?></h5>
            <a href="/cat-menu/create" class="btn btn-primary col-1">Agregar</a>
        </div>

        <div class="row">
            <?php foreach ($categories as $cat) : ?>
                <div class="col-4">
                    <div class="card card-user">
                        <div class="card-body">
                            <p class="card-text">
                            <div class="author">
                                <div class="block block-one"></div>
                                <div class="block block-two"></div>
                                <div class="block block-three"></div>
                                <div class="block block-four"></div>
                                <a href="/cat-menu-item/platillos/?id=<?= $cat->id ?>">
                                    <img class="avatar" src="" alt="">
                                    <h5 class="title h3"><?= $cat->catmen_name ?></h5>
                                </a>
                                <!-- <p class="description">a</p> -->
                                <p class="card-description"><?= $cat->catmen_description ?></p>
                                <!-- <p class="card-description" style="color: red">asd</p> -->
                            </div>
                            </p>
                        </div>
                        <div class="card-footer">
                            <div class="button-container">
                                <a href="/restaurant/<?= $cat->id ?>" class="btn btn-icon btn-round"><i class="fas fa-solid fa-eye"></i></a>
                                <a href="/restaurant/update/<?= $cat->id ?>" class="btn btn-icon btn-round"><i class="fas fa-solid fa-eye-dropper"></i></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>