<?php

use yii\helpers\Html;
use app\models\Utilities;
?>

<?= $this->render('/layouts/sidebar-left') ?>

<div class="main-panel">

    <?= $this->render('/layouts/navbar') ?>

    <div class="content">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Mis Restaurantes</a></li>
                <li class="breadcrumb-item"><a href="/restaurant/view/<?= Utilities::$restaurant->id ?>"><?= Utilities::$restaurant->res_name ?></a></li>
                <li class="breadcrumb-item"><a href="/restaurant/view/<?= Utilities::$restaurant->id ?>">Categorias</a></li>
                <li class="breadcrumb-item active" aria-current="page">Agregar</li>
            </ol>
        </nav>
        <!-- My content -->
        <div class="restaurant-create">
            <h1><?= Html::encode($this->title) ?></h1>

            <?php // $this->render('_form', compact('cat_menu')) 
            ?>

        </div>
    </div>
</div>