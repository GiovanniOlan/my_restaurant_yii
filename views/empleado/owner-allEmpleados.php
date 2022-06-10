<?php

use yii\bootstrap4\Html;

$this->title = "Empleados ({$restaurant->res_name})"

?>

<?= $this->render('/layouts/sidebar-left-restaurant') ?>

<div class="main-panel">

    <?= $this->render('/layouts/navbar') ?>

    <div class="content">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Mis Restaurantes</a></li>
                <li class="breadcrumb-item"><a href="/restaurant/view/<?= $restaurant->id ?>"><?= $restaurant->res_name ?></a></li>
                <li class="breadcrumb-item active" aria-current="page">Empleados</li>
            </ol>
        </nav>
        <!-- My content -->
        <div class="catmenuitem-allPlatillos">
            <h1><?= Html::encode($this->title) ?><a href="/empleado/create"><i style='font-size:25px; margin-left: 10px;' class="tim-icons icon-simple-add"></i></a></h1>

            <div class="card-body row">
                <?php foreach ($empleados as $emp) : ?>
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
                                        <img class="avatar" src="<?= $emp->empFkusercustom->photoUrl ?>" alt="">
                                        <h5 class="title h3"><?= $emp->empFkusercustom->longName ?></h5>
                                    </a>
                                    <!-- <p class="description">a</p> -->
                                    <p class="card-description"><?= $emp->emp_description ?></p>
                                    <!-- <p class="card-description" style="color: red">asd</p> -->
                                </div>
                                </p>
                            </div>
                            <div class="card-footer">
                                <div class="button-container">
                                    <a href="/empleado/view?id=<?= $emp->id ?>" class="btn btn-icon btn-round"><i class="fas fa-solid fa-eye"></i></a>
                                    <a href="/empleado/update?id=<?= $emp->id ?>" class="btn btn-icon btn-round"><i class="fas fa-solid fa-eye-dropper"></i></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>

            </div>
        </div>
    </div>