<?php

use yii\bootstrap4\Html;

$this->title = "EDITAR: {$cat_menu_item->catmenite_name}"

?>

<?= $this->render('/layouts/sidebar-left-restaurant') ?>

<div class="main-panel">

    <?= $this->render('/layouts/navbar') ?>

    <div class="content">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Mis Restaurantes</a></li>
                <li class="breadcrumb-item"><a href="/restaurant/view/<?= $restaurant->id ?>"><?= $restaurant->res_name ?></a></li>
                <li class="breadcrumb-item"><a href="/cat-menu-item/platillos">Platillos</a></li>
                <li class="breadcrumb-item"><a href="/cat-menu-item/view/?id=<?= $cat_menu_item->id ?>"><?= $cat_menu_item->catmenite_name ?></a></li>
                <li class="breadcrumb-item active" aria-current="page">Editar</li>
            </ol>
        </nav>
        <!-- My content -->
        <div class="catmenuitem-allPlatillos">
            <h1><?= Html::encode($this->title) ?></h1>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <?= $this->render('_form', compact('cat_menu_item', 'restaurant')) ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>