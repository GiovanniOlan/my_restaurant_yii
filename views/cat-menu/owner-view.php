<?php

use yii\bootstrap4\Html;
use yii\widgets\DetailView;

?>

<?= $this->render('/layouts/sidebar-left-restaurant') ?>

<div class="main-panel">
    <?= $this->render('/layouts/navbar') ?>
    <div class="content">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Mis Restaurantes</a></li>
                <li class="breadcrumb-item"><a href="/restaurant/view/<?= $restaurant->id ?>"><?= $restaurant->res_name ?></a></li>
                <li class="breadcrumb-item"><a href="/cat-menu/categorias/?id=<?= $restaurant->id ?>">Categorias</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= $cat_menu->catmen_name ?></li>
            </ol>
        </nav>
        <!-- My content -->
        <h1><?= Html::encode($this->title) ?></h1>

        <div class="cat_menu-view">
            <p>
                <?= Html::a('Editar', ['update', 'id' => $cat_menu->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Eliminar', ['delete', 'id' => $cat_menu->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => '¿Estás seguro que quieres eliminar este dato?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>
            <?= DetailView::widget([
                'model' => $cat_menu,
                'attributes' => [
                    'catmen_name',
                    'catmen_description:ntext',
                    [
                        'label' => 'Imagen',
                        'attribute' => 'imageHtml',
                        'format' => 'raw',
                    ],
                    [
                        'label' => 'Restaurante',
                        'value' => $cat_menu->catmenFkrestaurant->res_name,
                    ],
                ],
            ]) ?>

        </div>
    </div>
</div>