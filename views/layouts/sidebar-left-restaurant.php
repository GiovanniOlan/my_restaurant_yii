<?php

use app\models\Utilities;
use app\models\Restaurant;


$id_restaurant = Yii::$app->getRequest()->getCookies()->getValue('id_restaurant');

$restaurant = Restaurant::find()->where(['id' => $id_restaurant])->one();


?>

<div class="sidebar">
    <div class="sidebar-wrapper">
        <div class="logo">
            <!-- <a href="javascript:void(0)" class="simple-text logo-mini">
                CT
            </a> -->
            <a href="javascript:void(0)" class="simple-text logo-normal text-center">
                <?= $restaurant->res_name ?>
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
                <a href="/empleado/todos">
                    <i class="tim-icons icon-atom"></i>
                    <p>Personal</p>
                </a>
            </li>
            <li>
                <a href="/restaurant/reportes">
                    <i class="tim-icons icon-single-02"></i>
                    <p>Reportes</p>
                </a>
            </li>

        </ul>
    </div>
</div>