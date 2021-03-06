<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CatMenu */

$this->title = 'Update Cat Menu: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cat Menus', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cat-menu-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
