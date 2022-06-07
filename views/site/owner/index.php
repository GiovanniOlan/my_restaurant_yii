<?php

use app\models\UserOwner;
use app\models\UserCustom;

$user_owner = UserOwner::getUserOwnerLogged();

$restaurants = $user_owner->restaurants;


?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Inicio</li>
    </ol>
</nav>

<h5 class="h3" style="color: #fff;">Cuentas</h5>

<div class="row">
    <!-- for -->
    <div class="col-4">
        <div class="card card-user">
            <div class="card-body">
                <p class="card-text">
                <div class="author">
                    <div class="block block-one"></div>
                    <div class="block block-two"></div>
                    <div class="block block-three"></div>
                    <div class="block block-four"></div>
                    <a href="javascript:void(0)">
                        <img class="avatar" src="" alt="...">
                        <h5 class="title h3">asdasd</h5>
                    </a>
                    <p class="description">
                        asdasd
                    </p>
                    <p class="card-description">asdasd</p>
                    <p class="card-description" style="color: red">asd</p>
                </div>
                </p>
            </div>
            <div class="card-footer">
                <div class="button-container">
                    <a href="" class="btn btn-icon btn-round"><i class="fas fa-solid fa-eye"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- endfor -->

</div>