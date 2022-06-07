<?php

use app\models\UserOwner;
use app\models\UserCustom;

$user_owner = UserOwner::getUserOwnerLogged();

$restaurants = $user_owner->restaurants;

$this->title = 'Restaurantes';
$this->params['breadcrumbs'][] = $this->title;

?>

<?= $this->render('/layouts/sidebar-left') ?>

<div class="main-panel">
    <?= $this->render('/layouts/navbar') ?>
    <div class="content">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Mis restaurantes</li>
            </ol>
        </nav>
        <!-- My content -->
        <h5 class="h3" style="color: #fff;">Mis Restaurantes</h5>

        <div class="row">
            <?php foreach ($restaurants as $res) : ?>
                <div class="col-4">
                    <div class="card card-user">
                        <div class="card-body">
                            <p class="card-text">
                            <div class="author">
                                <div class="block block-one"></div>
                                <div class="block block-two"></div>
                                <div class="block block-three"></div>
                                <div class="block block-four"></div>
                                <a href="">
                                    <img class="avatar" src="<?= $res->getMainImageUrl() ?>" alt="<?= $res->res_name ?>">
                                    <h5 class="title h3"><?= $res->res_name ?></h5>
                                </a>
                                <p class="description"><?= $res->res_slogan ?></p>
                                <p class="card-description"><?= $res->res_description ?></p>
                                <!-- <p class="card-description" style="color: red">asd</p> -->
                            </div>
                            </p>
                        </div>
                        <div class="card-footer">
                            <div class="button-container">
                                <a href="/restaurant/<?= $res->id ?>" class="btn btn-icon btn-round"><i class="fas fa-solid fa-eye"></i></a>
                                <a href="/restaurant/update/<?= $res->id ?>" class="btn btn-icon btn-round"><i class="fas fa-solid fa-eye-dropper"></i></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>