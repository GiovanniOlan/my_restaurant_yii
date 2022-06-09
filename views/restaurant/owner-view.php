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
                <li class="breadcrumb-item active" aria-current="page"><?= $restaurant->res_name ?></li>
            </ol>
        </nav>
        <!-- My content -->
        <h1><?= Html::encode($this->title) ?></h1>

        <div class="restaurant-view">


            <p>
                <?= Html::a('Editar', ['update', 'id' => $restaurant->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Eliminar', ['delete', 'id' => $restaurant->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => '¿Estás seguro que quieres eliminar este dato?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>

            <?= DetailView::widget([
                'model' => $restaurant,
                'attributes' => [
                    'res_name',
                    'res_description:ntext',
                    'res_slogan',
                    [
                        'label' => 'Logo',
                        'attribute' => 'logoHtml',
                        'format' => 'raw',
                    ],
                    [
                        'label' => 'Imagen Principal',
                        'attribute' => 'mainImageHtml',
                        'format' => 'raw',
                    ],
                    // [
                    //     'label' => 'Logo',
                    //     'value' => $restaurant->getLogoHtml(),
                    //     'format' => 'raw',
                    // ],
                ],
            ]) ?>

        </div>
    </div>
</div>