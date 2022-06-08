<?php

use app\models\Utilities;
use app\models\Restaurant;


?>

<div class="sidebar">
    <div class="sidebar-wrapper">
        <div class="logo">
            <!-- <a href="javascript:void(0)" class="simple-text logo-mini">
                CT
            </a> -->
            <a href="javascript:void(0)" class="simple-text logo-normal text-center">
                <?= Restaurant::find()->where(['id' => $restaurant->id])->one()->res_name ?>
            </a>
        </div>
        <ul class="nav">
            <!-- <li>
                <a href="/">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>Mis Restaurantes</p>
                </a>
            </li> -->
            <li>
                <a href="/cat-menu/categorias/?id=<?= $restaurant->id ?>">
                    <i class="tim-icons icon-single-02"></i>
                    <p>Categorias</p>
                </a>
            </li>
            <li>
                <a href="/cat-menu-item/platillos">
                    <i class="tim-icons icon-atom"></i>
                    <p>Platillos</p>
                </a>
            </li>
            <li>
                <a href="/cat-menu-item/platillos">
                    <i class="tim-icons icon-atom"></i>
                    <p>Clientes</p>
                </a>
            </li>
            <li>
                <a href="">
                    <i class="tim-icons icon-single-02"></i>
                    <p>Pedidos</p>
                </a>
            </li>

        </ul>
    </div>
</div>