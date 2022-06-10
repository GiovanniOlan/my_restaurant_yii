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
                <li class="breadcrumb-item"><a href="/empleado/todos">Empleados</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= $empleado->empFkusercustom->longName ?></li>
            </ol>
        </nav>
        <!-- My content -->
        <h1><?= Html::encode($this->title) ?></h1>

        <div class="cat_menu-view">
            <p>
                <?= Html::a('Editar', ['update', 'id' => $empleado->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Eliminar', ['delete', 'id' => $empleado->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => '¿Estás seguro que quieres eliminar este dato?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>
            <?= DetailView::widget([
                'model' => $empleado,
                'attributes' => [
                    [
                        'label' => 'Nombre Completo',
                        'value' => $empleado->empFkusercustom->longName,
                    ],
                    'emp_curp',
                    'emp_rfc',
                    [
                        'label' => 'Correo',
                        'value' => $empleado->empFkusercustom->usuFkuser->email,
                        'format' => 'raw'
                    ],
                    [
                        'label' => 'Nombre De Usuario (Login)',
                        'value' => $empleado->empFkusercustom->usuFkuser->username,
                        'format' => 'raw'
                    ],
                    'emp_description:ntext',
                    [
                        'label' => 'Restaurante',
                        'value' => $empleado->empFkrestaurant->res_name,
                    ],
                    [
                        'label' => 'Foto',
                        'value' => $empleado->empFkusercustom->photoHtml,
                        'format' => 'raw'
                    ],
                ],
            ]) ?>

        </div>
    </div>
</div>