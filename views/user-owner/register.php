<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserOwner */

$this->title = 'Registrarte';
$this->params['breadcrumbs'][] = ['label' => 'User Owners', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-owner-create">

    <?= Yii::$app->session->getFlash('error'); ?>

    <h1><?= Html::encode($this->title) ?></h1>

    <?=

    $this->render('_form', compact('user', 'user_owner', 'user_custom'))
    ?>

</div>