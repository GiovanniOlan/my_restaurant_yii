<?php

use yii\bootstrap4\Html;

$this->title = "Editar: {$empleado->empFkusercustom->longName}"

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
                <li class="breadcrumb-item"><a href="/empleado/view/?id=<?= $empleado->id ?>"><?= $empleado->empFkusercustom->longName ?></a></li>
                <li class="breadcrumb-item active" aria-current="page">Editar</li>
            </ol>
        </nav>
        <!-- My content -->
        <div class="catmenuitem-allPlatillos">
            <h1><?= Html::encode($this->title) ?></h1>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <?= $this->render('_form', compact('empleado', 'user', 'user_custom')) ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>