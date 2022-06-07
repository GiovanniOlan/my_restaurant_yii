<?php

use yii\bootstrap4\Html;
use app\models\UserOwner;
use app\models\UserCustom;
use yii\widgets\DetailView;

$user_owner = UserOwner::getUserOwnerLogged();

$restaurants = $user_owner->restaurants;

$this->title = $restaurant->res_name;

?>

<?= $this->render('/layouts/sidebar-left') ?>

<div class="main-panel">
    <?= $this->render('/layouts/navbar') ?>
    <div class="content">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Mis Restaurantes</a></li>
                <li class="breadcrumb-item"><a href="/restaurant/view/<?= $restaurant->id ?>"><?= $this->title ?></a></li>
                <li class="breadcrumb-item active" aria-current="page">Editar</li>
            </ol>
        </nav>
        <!-- My content -->
        <h1><?= Html::encode("Editando: {$this->title}") ?></h1>

        <div class="restaurant-update">

            <?= $this->render('_form', compact('restaurant')) ?>

        </div>
    </div>
</div>