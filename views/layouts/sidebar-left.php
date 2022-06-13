<?php

use yii\bootstrap4\Html;
use webvimark\modules\UserManagement\UserManagementModule;


?>

<div class="sidebar">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="javascript:void(0)" class="simple-text logo-mini">
                MR
            </a>
            <a href="javascript:void(0)" class="simple-text logo-normal">
                Opciones
            </a>
        </div>
        <ul class="nav">
            <li>
                <a href="/">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>Mis Restaurantes</p>
                </a>
            </li>
            <li>
                <a href="/restaurant/create">
                    <i class="tim-icons icon-single-02"></i>
                    <p>Agregar Restaurante</p>
                </a>
            </li>
            <?php if (Yii::$app->user->isSuperAdmin) : ?>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon dw dw-user-13"></span><span class="mtext">Gestion de Usuarios</span>
                    </a>
                    <ul class="submenu">
                        <li class="micon dw dw-user-2"><a href=" /user-management/user/index"> <?= Html::encode(UserManagementModule::t('back', 'Users')) ?></a></li>
                        <li class="micon "><a href="/user-management/role/index"> <?= Html::encode(UserManagementModule::t('back', 'Roles')) ?></a></li>
                        <li class="micon "><a href="/user-management/permission/index"> <?= Html::encode(UserManagementModule::t('back', 'Permissions')) ?></a></li>
                        <li class="micon "><a href="/user-management/auth-item-group/index"> <?= Html::encode(UserManagementModule::t('back', 'Permission groups')) ?></a></li>
                        <li class="micon "><a href="/user-management/user-visit-log/index"> <?= Html::encode(UserManagementModule::t('back', 'Visit log')) ?></a></li>
                    </ul>
                </li>
            <?php endif ?>

        </ul>
    </div>
</div>