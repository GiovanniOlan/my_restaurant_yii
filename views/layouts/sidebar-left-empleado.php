<?php

use app\models\Empleado;
use app\models\Utilities;
use app\models\Restaurant;


$empleado = Empleado::getEmpleadoLogged();

$restaurant = $empleado->empFkrestaurant;


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
                <a href="/empleado/">
                    <i class="tim-icons icon-atom"></i>
                    <p>Pedidos</p>
                </a>
            </li>
        </ul>
    </div>
</div>