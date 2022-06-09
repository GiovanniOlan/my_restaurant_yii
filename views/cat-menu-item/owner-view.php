<?php

use yii\bootstrap4\Html;
use yii\widgets\DetailView;

$this->title = "{$cat_menu_item->catmenite_name}"

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
                <li class="breadcrumb-item active" aria-current="page"><?= Html::encode($this->title) ?></li>
            </ol>
        </nav>
        <!-- My content -->
        <div class="catmenuitem-allPlatillos">
            <h1><?= Html::encode($this->title) ?></h1>
            <p>
                <?= Html::a('Editar', ['update', 'id' => $cat_menu_item->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Eliminar', ['delete', 'id' => $cat_menu_item->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => '¿Estás seguro que quieres eliminar este dato?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        <?= DetailView::widget([
                            'model' => $cat_menu_item,
                            'attributes' => [
                                'catmenite_name',
                                'catmenite_description:ntext',
                                'catmenite_for',
                                'catmenite_price',
                                [
                                    'label' => 'Categoria',
                                    'value' => $cat_menu_item->catmeniteFkcatmenu->catmen_name
                                ],
                                [
                                    'label' => 'Imagen',
                                    'attribute' => 'imageHtml',
                                    'format' => 'raw'
                                ],
                            ],
                        ]) ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>