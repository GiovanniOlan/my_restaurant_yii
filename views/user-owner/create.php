<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserOwner */

$this->title = 'Create User Owner';
$this->params['breadcrumbs'][] = ['label' => 'User Owners', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-owner-create">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>